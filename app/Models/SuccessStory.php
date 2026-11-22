<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuccessStory extends Model
{
    protected $fillable = [
        'title', 'domain', 'story_text', 'timeline', 'user_id', 'status' // status: pending/approved/rejected
    ];
    protected $casts = ['timeline' => 'json']; // e.g., ["education": "...", "challenges": "...", "outcome": "..."]

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}