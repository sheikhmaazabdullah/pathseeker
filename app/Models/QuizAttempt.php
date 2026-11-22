<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    protected $fillable = ['user_id', 'quiz_id', 'score', 'completed_at', 'responses'];
    protected $casts = ['responses' => 'json'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function getPercentageAttribute()
    {
        $quiz = $this->quiz;
        $questions = $quiz->questions;
        $totalQuestions = $questions->count();
        $maxScore = $totalQuestions * ($quiz->scoring_logic['correct'] ?? 10); // Assuming 'correct' is the base score per question
        return $this->score ? round(($this->score / $maxScore) * 100, 2) : 0;
    }
}