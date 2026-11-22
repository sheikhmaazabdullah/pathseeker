<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Mail\VerificationOtpMail;
use Illuminate\Support\Facades\Log;

class CustomVerifyEmail extends Notification
{
    use Queueable;

    public function __construct()
    {
        //
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        if (!$notifiable->email) {
            Log::error('No email address in notifiable', ['notifiable' => $notifiable]);
            return (new MailMessage)->subject('Error')->line('No email address available.');
        }
        Log::info('Notification toMail', ['notifiable_email' => $notifiable->email, 'user_id' => $notifiable->id]);

        $otp = rand(100000, 999999);
        $notifiable->otp = $otp;
        $notifiable->otp_created_at = now();
        $notifiable->save();

        $verificationUrl = route('verify'); // Point to OTP entry page
        return (new VerificationOtpMail($notifiable, $verificationUrl, $otp))
            ->to($notifiable->email)
            ->subject('Registration Request Received - PathSeeker');
    }
}