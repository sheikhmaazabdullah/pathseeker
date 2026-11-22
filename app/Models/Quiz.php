<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    protected $fillable = ['title', 'category', 'focus_user_type', 'scoring_logic'];
    protected $casts = [
        'scoring_logic' => 'json',
    ];

    // Relationship with quiz questions
    public function questions(): HasMany
    {
        return $this->hasMany(QuizQuestion::class);
    }

    // Accessor to stringify scoring_logic for safe display
    public function getScoringLogicStringAttribute()
    {
        return $this->scoring_logic ? json_encode($this->scoring_logic, JSON_PRETTY_PRINT) : 'N/A';
    }
}