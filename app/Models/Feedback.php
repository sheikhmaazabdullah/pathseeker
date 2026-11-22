<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'user_id', 'type', 'message', 'sentiment' // type: bug/suggestion/query; sentiment: positive/negative/neutral (admin-set)
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // No JSON fields, so no additional casting/accessors needed
}