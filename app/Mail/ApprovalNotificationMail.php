<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class ApprovalNotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $status;

    public function __construct(User $user, $status)
    {
        $this->user = $user;
        $this->status = $status;
    }

    public function build()
    {
        return $this->subject('Registration ' . ucfirst($this->status) . ' - PathSeeker')
                    ->view('emails.approval-notification');
    }
}