<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class RegistrationNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $otp;

    public function __construct(User $user, $otp)
    {
        $this->user = $user;
        $this->otp = $otp;
    }

    public function build()
    {
        $verificationUrl = url('/email/verify/' . $this->user->id . '/' . sha1($this->user->getEmailForVerification()));
        return $this->subject('Registration Request Received - PathSeeker')
                    ->view('emails.registration-notification')
                    ->with([
                        'verificationUrl' => $verificationUrl,
                        'otp' => $this->otp,
                    ]);
    }
}