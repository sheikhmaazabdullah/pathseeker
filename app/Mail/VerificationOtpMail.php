<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class VerificationOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $verificationUrl;
    public $otp;

    public function __construct(User $user, $verificationUrl, $otp)
    {
        $this->user = $user;
        $this->verificationUrl = $verificationUrl;
        $this->otp = $otp;
    }

    public function build()
    {
        return $this->subject('Registration Request Received - PathSeeker')
                    ->view('emails.verification-otp')
                    ->with([
                        'verificationUrl' => $this->verificationUrl,
                        'otp' => $this->otp,
                    ]);
    }
}