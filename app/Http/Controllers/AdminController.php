<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Career;
use App\Models\Quiz;
use App\Models\Multimedia;
use App\Models\SuccessStory;
use App\Models\Feedback;
use App\Models\QuizAttempt;
use App\Models\CareerRecommendation;
use Illuminate\Support\Facades\Storage;
use App\Mail\ApprovalNotificationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'active_users' => User::whereNotNull('last_login_at')
                                ->where('last_login_at', '>', now()->subDays(30))
                                ->count(),
            'pending_users' => User::where('status', 'pending')->whereNotNull('email_verified_at')->count(),
            'quiz_attempts' => QuizAttempt::count(),
            'popular_content' => Multimedia::orderByDesc('download_count')->take(5)->get(),
            'success_stories' => SuccessStory::where('status', 'approved')->count(),
            'pending_feedback' => Feedback::where('status', 'pending')->count(),
            'user_activity' => User::selectRaw('CAST(created_at AS DATE) as date, COUNT(*) as count')
                                ->where('created_at', '>=', now()->subDays(7))
                                ->groupBy(DB::raw('CAST(created_at AS DATE)'))
                                ->orderBy('date')
                                ->take(5)
                                ->get(),
            'recent_quiz_attempts' => QuizAttempt::with('quiz')
                                ->orderByDesc('created_at')
                                ->take(5)
                                ->get(),
            'recent_feedback' => Feedback::with('user')
                                ->where('status', 'pending')
                                ->orderByDesc('created_at')
                                ->take(5)
                                ->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    // User Management
    public function users()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    public function addUser()
    {
        return view('admin.add-user');
    }

    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:student,graduate,professional,admin',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('admin.users')->with('success', 'User added successfully.');
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit-user', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:student,graduate,professional,admin',
            'password' => 'nullable|string|min:8',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]);

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    public function viewUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.view-user', compact('user'));
    }

    public function usersequests()
    {
        $pendingUsers = User::where('status', 'pending')->whereNotNull('email_verified_at')->get();
        return view('admin.usersequests', compact('pendingUsers'));
    }

    public function approveUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = 'approved';
        $user->save();

        Mail::to($user->email)->send(new ApprovalNotificationMail($user, 'approved'));
        return redirect()->back()->with('success', 'User approved.');
    }

    public function rejectUser(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->status = 'rejected';
        $user->save();

        Mail::to($user->email)->send(new ApprovalNotificationMail($user, 'rejected'));
        return redirect()->back()->with('success', 'User rejected.');
    }

    // Career Management
    public function careers()
    {
        $careers = Career::all();
        return view('admin.careers', compact('careers'));
    }

    public function addCareer()
    {
        return view('admin.add-career');
    }

    public function storeCareer(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'domain' => 'required|string|max:255',
            'salary' => 'nullable|numeric',
            'description' => 'nullable|string',
            'requirements' => 'nullable|json',
            'demand_level' => 'nullable|in:high,medium,low',
        ]);
        Career::create($request->all());
        return redirect()->route('admin.careers')->with('success', 'Career added successfully.');
    }

    public function editCareer($id)
    {
        $career = Career::findOrFail($id);
        return view('admin.edit-career', compact('career'));
    }

    public function updateCareer(Request $request, $id)
    {
        $career = Career::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'domain' => 'required|string|max:255',
            'salary' => 'nullable|numeric',
            'description' => 'nullable|string',
            'requirements' => 'nullable|json',
            'demand_level' => 'nullable|in:high,medium,low',
        ]);
        $career->update($request->all());
        return redirect()->route('admin.careers')->with('success', 'Career updated successfully.');
    }

    public function deleteCareer($id)
    {
        Career::findOrFail($id)->delete();
        return redirect()->route('admin.careers')->with('success', 'Career deleted successfully.');
    }

    public function viewCareer($id)
    {
        $career = Career::findOrFail($id);
        $user = auth()->user(); // Assuming the logged-in user
        $recommendations = [];

        if ($user) {
            $quizAttempts = QuizAttempt::where('user_id', $user->id)
                ->with('quiz')
                ->get();
            $categoryScores = [];

            foreach ($quizAttempts as $attempt) {
                $category = $attempt->quiz->category;
                $percentage = $attempt->percentage;
                $categoryScores[$category] = max($categoryScores[$category] ?? 0, $percentage);
            }

            if (!empty($categoryScores)) {
                $maxPercentage = max(array_values($categoryScores));
                $recommendations = Career::whereIn('domain', array_keys($categoryScores))
                    ->whereHas('recommendations', function ($query) use ($categoryScores, $maxPercentage) {
                        $query->whereIn('quiz_category', array_keys($categoryScores))
                              ->where('min_percentage', '<=', $maxPercentage);
                    })
                    ->get()
                    ->where('id', '!=', $career->id)
                    ->take(3);
            }
        }

        return view('admin.view-career', compact('career', 'recommendations'));
    }

    // Career Recommendation Management
    public function manageRecommendations()
    {
        $careers = Career::with('recommendations')->get();
        $quizTypes = ['Technology', 'Design', 'Business', 'Health']; // Predefined quiz types
        return view('admin.manage-recommendations', compact('careers', 'quizTypes'));
    }

    public function addRecommendation(Request $request)
    {
        $request->validate([
            'career_id' => 'required|exists:careers,id',
            'quiz_category' => 'required|in:Technology,Design,Business,Health',
            'min_percentage' => 'required|numeric|min:0|max:100',
        ]);

        $career = Career::findOrFail($request->career_id);
        $career->recommendations()->create([
            'quiz_category' => $request->quiz_category,
            'min_percentage' => $request->min_percentage,
        ]);

        return redirect()->route('admin.manage-recommendations')->with('success', 'Recommendation added successfully.');
    }

    public function editRecommendation($id)
    {
        $recommendation = CareerRecommendation::findOrFail($id);
        $careers = Career::all();
        $quizTypes = ['Technology', 'Design', 'Business', 'Health'];
        return view('admin.edit-recommendation', compact('recommendation', 'careers', 'quizTypes'));
    }

    public function updateRecommendation(Request $request, $id)
    {
        $recommendation = CareerRecommendation::findOrFail($id);
        $request->validate([
            'career_id' => 'required|exists:careers,id',
            'quiz_category' => 'required|in:Technology,Design,Business,Health',
            'min_percentage' => 'required|numeric|min:0|max:100',
        ]);

        $recommendation->update([
            'career_id' => $request->career_id,
            'quiz_category' => $request->quiz_category,
            'min_percentage' => $request->min_percentage,
        ]);

        return redirect()->route('admin.manage-recommendations')->with('success', 'Recommendation updated successfully.');
    }

    public function deleteRecommendation($id)
    {
        $recommendation = CareerRecommendation::findOrFail($id);
        $recommendation->delete();
        return redirect()->route('admin.manage-recommendations')->with('success', 'Recommendation deleted successfully.');
    }

    // Quiz Management
    public function quizzes()
    {
        $quizzes = Quiz::withCount('questions')->get();
        return view('admin.quizzes', compact('quizzes'));
    }

    public function addQuiz()
    {
        return view('admin.add-quiz');
    }

    public function storeQuiz(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'focus_user_type' => 'nullable|in:student,graduate,professional',
            'scoring_logic' => 'nullable|json',
            'questions' => 'required|array',
            'questions.*.text' => 'required|string|max:255',
            'questions.*.options' => 'required|json',
            'questions.*.answer' => 'required|string|max:100',
            'questions.*.weight' => 'nullable|integer|min:1',
        ]);

        $quiz = Quiz::create($request->only(['title', 'category', 'focus_user_type', 'scoring_logic']));

        foreach ($request->questions as $questionData) {
            $quiz->questions()->create([
                'text' => $questionData['text'],
                'options' => json_encode($questionData['options']),
                'answer' => $questionData['answer'],
                'weight' => $questionData['weight'] ?? 10,
            ]);
        }

        return redirect()->route('admin.quizzes')->with('success', 'Quiz added successfully.');
    }

    public function editQuiz($id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);
        return view('admin.edit-quiz', compact('quiz'));
    }

    public function updateQuiz(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'focus_user_type' => 'nullable|in:student,graduate,professional',
            'scoring_logic' => 'nullable|json',
            'questions' => 'required|array',
            'questions.*.id' => 'nullable|exists:quiz_questions,id,quiz_id,' . $id,
            'questions.*.text' => 'required|string|max:255',
            'questions.*.options' => 'required|json',
            'questions.*.answer' => 'required|string|max:100',
            'questions.*.weight' => 'nullable|integer|min:1',
        ]);

        $quiz->update($request->only(['title', 'category', 'focus_user_type', 'scoring_logic']));

        $existingQuestionIds = $quiz->questions->pluck('id')->toArray();
        $newQuestions = [];

        foreach ($request->questions as $questionData) {
            if (isset($questionData['id'])) {
                $question = $quiz->questions()->find($questionData['id']);
                if ($question) {
                    $question->update([
                        'text' => $questionData['text'],
                        'options' => json_encode($questionData['options']),
                        'answer' => $questionData['answer'],
                        'weight' => $questionData['weight'] ?? 10,
                    ]);
                    $existingQuestionIds = array_diff($existingQuestionIds, [$questionData['id']]);
                }
            } else {
                $newQuestions[] = [
                    'text' => $questionData['text'],
                    'options' => json_encode($questionData['options']),
                    'answer' => $questionData['answer'],
                    'weight' => $questionData['weight'] ?? 10,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        if (!empty($newQuestions)) {
            $quiz->questions()->createMany($newQuestions);
        }

        if (!empty($existingQuestionIds)) {
            $quiz->questions()->whereIn('id', $existingQuestionIds)->delete();
        }

        return redirect()->route('admin.quizzes')->with('success', 'Quiz updated successfully.');
    }

    public function deleteQuiz($id)
    {
        Quiz::findOrFail($id)->delete();
        return redirect()->route('admin.quizzes')->with('success', 'Quiz deleted successfully.');
    }

    public function viewQuiz($id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);
        return view('admin.view-quiz', compact('quiz'));
    }

    // Multimedia Management
    public function multimedia()
    {
        $multimedia = Multimedia::all();
        return view('admin.multimedia', compact('multimedia'));
    }

    public function uploadContent()
    {
        return view('admin.upload-content');
    }

    public function storeContent(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,docx,jpg,png,mp4|max:10240',
            'title' => 'required|string|max:255',
            'type' => 'required|in:video,image,pdf',
            'tags' => 'nullable|json',
            'category' => 'nullable|string|max:100',
        ]);
        $path = $request->file('file')->store('uploads', 'public');
        Multimedia::create(array_merge($request->only(['title', 'type', 'tags', 'category']), ['file_path' => $path]));
        return redirect()->route('admin.multimedia')->with('success', 'Content uploaded successfully.');
    }

    public function editMultimedia($id)
    {
        $multimedia = Multimedia::findOrFail($id);
        return view('admin.edit-multimedia', compact('multimedia'));
    }

    public function updateMultimedia(Request $request, $id)
    {
        $multimedia = Multimedia::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:video,image,pdf',
            'tags' => 'nullable|json',
            'category' => 'nullable|string|max:100',
            'file' => 'nullable|file|mimes:pdf,docx,jpg,png,mp4|max:10240',
        ]);
        if ($request->hasFile('file')) {
            Storage::delete('public/' . $multimedia->file_path);
            $path = $request->file('file')->store('uploads', 'public');
            $multimedia->update(['file_path' => $path]);
        }
        $multimedia->update($request->only(['title', 'type', 'tags', 'category']));
        return redirect()->route('admin.multimedia')->with('success', 'Multimedia updated successfully.');
    }

    public function deleteMultimedia($id)
    {
        $multimedia = Multimedia::findOrFail($id);
        Storage::delete('public/' . $multimedia->file_path);
        $multimedia->delete();
        return redirect()->route('admin.multimedia')->with('success', 'Multimedia deleted successfully.');
    }

    public function viewMultimedia($id)
    {
        $multimedia = Multimedia::findOrFail($id);
        return view('admin.view-multimedia', compact('multimedia'));
    }

    // Success Stories Management
    public function successStories()
    {
        $stories = SuccessStory::with('user')->get();
        return view('admin.success-stories', compact('stories'));
    }

    public function addSuccessStory()
    {
        return view('admin.add-success-story');
    }

    public function storeSuccessStory(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'domain' => 'required|string|max:255',
            'story_text' => 'required|string',
            'timeline' => 'nullable|json',
            'user_id' => 'nullable|exists:users,id',
        ]);
        SuccessStory::create($request->all());
        return redirect()->route('admin.success-stories')->with('success', 'Success story added (pending approval).');
    }

    public function editSuccessStory($id)
    {
        $story = SuccessStory::findOrFail($id);
        return view('admin.edit-success-story', compact('story'));
    }

    public function updateSuccessStory(Request $request, $id)
    {
        $story = SuccessStory::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'domain' => 'required|string|max:255',
            'story_text' => 'required|string',
            'timeline' => 'nullable|json',
            'status' => 'required|in:pending,approved,rejected',
        ]);
        $story->update($request->all());

        if ($request->status !== 'pending') {
            Mail::to($story->user->email)->send(new ApprovalNotificationMail($story->user, $request->status));
        }

        return redirect()->route('admin.success-stories')->with('success', 'Success story updated.');
    }

    public function deleteSuccessStory($id)
    {
        SuccessStory::findOrFail($id)->delete();
        return redirect()->route('admin.success-stories')->with('success', 'Success story deleted.');
    }

    public function viewSuccessStory($id)
    {
        $story = SuccessStory::with('user')->findOrFail($id);
        return view('admin.view-success-story', compact('story'));
    }

    // Feedback Management
    public function feedback()
    {
        $feedback = Feedback::with('user')->get();
        $analytics = [
            'by_type' => Feedback::groupBy('type')->pluck('type')->count() ?? [],
            'sentiment_summary' => Feedback::groupBy('sentiment')->pluck('sentiment')->count() ?? [],
        ];
        return view('admin.feedback', compact('feedback', 'analytics'));
    }

    public function addFeedback()
    {
        return view('admin.add-feedback');
    }

    public function storeFeedback(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'type' => 'required|in:bug,suggestion,query',
            'message' => 'required|string',
            'sentiment' => 'nullable|in:positive,negative,neutral',
        ]);
        Feedback::create($request->all());
        return redirect()->route('admin.feedback')->with('success', 'Feedback added.');
    }

    public function editFeedback($id)
    {
        $feedback = Feedback::findOrFail($id);
        return view('admin.edit-feedback', compact('feedback'));
    }

    public function updateFeedback(Request $request, $id)
    {
        $feedback = Feedback::findOrFail($id);
        $request->validate([
            'type' => 'required|in:bug,suggestion,query',
            'message' => 'required|string',
            'sentiment' => 'required|in:positive,negative,neutral',
        ]);
        $feedback->update($request->all());
        return redirect()->route('admin.feedback')->with('success', 'Feedback updated.');
    }

    public function deleteFeedback($id)
    {
        Feedback::findOrFail($id)->delete();
        return redirect()->route('admin.feedback')->with('success', 'Feedback deleted.');
    }

    public function viewFeedback($id)
    {
        $feedback = Feedback::with('user')->findOrFail($id);
        return view('admin.view-feedback', compact('feedback'));
    }
}