<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\MustVerifyEmail as BaseMustVerifyEmail;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, BaseMustVerifyEmail {
        sendEmailVerificationNotification as baseSendEmailVerificationNotification;
    }

    protected $fillable = [
        'email', 'password', 'name', 'role', 'education', 'skills', 'interests',
        'work_experience', 'resume_path', 'quiz_results', 'otp', 'otp_created_at', 'status'
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_created_at' => 'datetime',
        'skills' => 'json',
        'interests' => 'json',
        'quiz_results' => 'json',
    ];

    public function sendEmailVerificationNotification()
    {
        if (!$this->email) {
            Log::error('No email address available for user', ['user_id' => $this->id]);
            return;
        }
        Log::info('Sending verification to user', ['email' => $this->email, 'user_id' => $this->id]);
        $this->notify(new \App\Notifications\CustomVerifyEmail);
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class);
    }
}