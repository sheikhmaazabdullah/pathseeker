<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerRecommendation extends Model
{
    protected $fillable = ['career_id', 'quiz_category', 'min_percentage'];
    protected $table = 'career_recommendations';

    public function career()
    {
        return $this->belongsTo(Career::class);
    }
}