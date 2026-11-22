<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $fillable = ['title', 'domain', 'salary', 'description', 'requirements', 'demand_level'];
    protected $casts = ['requirements' => 'json'];

    // Accessor to stringify requirements for safe display
    public function getRequirementsStringAttribute()
    {
        return $this->requirements ? json_encode($this->requirements, JSON_PRETTY_PRINT) : 'N/A';
    }

    // Relationship with career_recommendations
    public function recommendations()
    {
        return $this->hasMany(CareerRecommendation::class, 'career_id');
    }
}