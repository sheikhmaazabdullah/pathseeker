<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizQuestion extends Model
{
    protected $fillable = ['quiz_id', 'text', 'options', 'answer', 'weight'];
    protected $casts = [
        'options' => 'json',
    ];

    // Relationship with quiz
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }
}