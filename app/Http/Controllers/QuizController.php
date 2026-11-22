<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizAttempt;
use App\Models\User;
use App\Models\Career;
use App\Models\CareerRecommendation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class QuizController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $quizzes = Quiz::where('focus_user_type', $user->role)->orWhereNull('focus_user_type')->get();
        return view('quiz.index', compact('quizzes', 'user'));
    }

    public function show($id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);
        $user = Auth::user();
        if ($quiz->focus_user_type && $quiz->focus_user_type !== $user->role) {
            return redirect()->route('quiz.index')->with('error', 'This quiz is not available for your user type.');
        }
        return view('quiz.show', compact('quiz', 'user'));
    }

    public function submit(Request $request, $id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);
        $user = Auth::user();

        // Get scoring logic from database
        $scoring = is_array($quiz->scoring_logic) ? $quiz->scoring_logic : (json_decode($quiz->scoring_logic, true) ?? ['correct' => 10, 'incorrect' => 0]);
        
        // Total max score is the 'correct' value from scoring_logic
        $maxScore = $scoring['correct'] ?? 10;
        
        // Calculate points per correct answer
        $numQuestions = $quiz->questions->count();
        $pointsPerCorrect = $numQuestions > 0 ? $maxScore / $numQuestions : 0;

        $responses = $request->input('answers', []);
        $totalScore = 0;
        $correctCount = 0;
        $incorrectCount = 0;
        $unansweredCount = 0;
        $answerDetails = [];

        foreach ($quiz->questions as $question) {
            $userAnswer = $responses[$question->id] ?? null;
            $answerDetails[$question->id] = [
                'question' => $question->text,
                'user_answer' => $userAnswer,
                'correct_answer' => $question->answer,
                'is_correct' => $userAnswer !== null && trim(strtolower($userAnswer)) === trim(strtolower($question->answer)),
            ];
            if ($userAnswer === null) {
                $unansweredCount++;
                // Unanswered questions contribute 0 points
            } elseif (trim(strtolower($userAnswer)) === trim(strtolower($question->answer))) {
                $totalScore += $pointsPerCorrect; // Dynamic points per correct answer
                $correctCount++;
            } else {
                $incorrectCount++; // Incorrect answers contribute 0 points
            }
        }

        // Log detailed information for debugging
        Log::info('Quiz ID: ' . $quiz->id . ', Scoring Logic: ' . json_encode($scoring) . ', Questions: ' . $numQuestions . ', Points per Correct: ' . $pointsPerCorrect . ', Responses: ' . json_encode($responses) . ', Correct: ' . $correctCount . ', Incorrect: ' . $incorrectCount . ', Unanswered: ' . $unansweredCount . ', Total Score: ' . $totalScore . ', Max Score: ' . $maxScore . ', Answer Details: ' . json_encode($answerDetails));

        $attempt = QuizAttempt::create([
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
            'score' => max(0, $totalScore), // Ensure score isn't negative
            'completed_at' => now(),
            'responses' => json_encode($responses),
        ]);

        return redirect()->route('quiz.result', $attempt->id);
    }

    public function result($attemptId)
    {
        $attempt = QuizAttempt::with('quiz.questions', 'user')->findOrFail($attemptId);
        $user = Auth::user();
        
        // Get scoring logic from database
        $scoring = is_array($attempt->quiz->scoring_logic) ? $attempt->quiz->scoring_logic : (json_decode($attempt->quiz->scoring_logic, true) ?? ['correct' => 10, 'incorrect' => 0]);
        
        // Total max score is the 'correct' value from scoring_logic
        $maxScore = $scoring['correct'] ?? 10;
        $percentage = $maxScore > 0 ? min(100, ($attempt->score / $maxScore) * 100) : 0;

        $recommendation = CareerRecommendation::where('quiz_category', $attempt->quiz->category)->first();
        $minPercentage = $recommendation ? $recommendation->min_percentage : 70;
        $career = $recommendation ? $recommendation->career : null;
        $recommendedCareer = $career ? $career->title : 'General IT';

        $recommendations = [];
        if ($percentage >= $minPercentage) {
            $recommendations[] = "You are well-suited for advanced roles in {$recommendedCareer}.";
        } elseif ($percentage >= $minPercentage * 0.7) {
            $recommendations[] = "Consider intermediate training in {$recommendedCareer}.";
        } else {
            $recommendations[] = "Explore foundational courses in {$recommendedCareer}.";
        }

        return view('quiz.result', compact('attempt', 'percentage', 'recommendations', 'user', 'maxScore', 'minPercentage', 'recommendedCareer'));
    }
}