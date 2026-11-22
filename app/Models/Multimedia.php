<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Multimedia extends Model
{
    protected $fillable = ['title', 'type', 'file_path', 'tags', 'category', 'download_count', 'avg_rating'];
    protected $casts = ['tags' => 'json']; // e.g., ["beginner", "skill-building"]

    // Accessor to stringify tags for safe display
    public function getTagsStringAttribute()
    {
        return $this->tags ? json_encode($this->tags, JSON_PRETTY_PRINT) : 'N/A';
    }
}