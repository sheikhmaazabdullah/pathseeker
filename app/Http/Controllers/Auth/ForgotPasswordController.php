<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ForgotPasswordMail;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $otp = rand(100000, 999999);
            $user->otp = $otp;
            $user->otp_created_at = now(); // Set creation timestamp
            $user->save();

            Mail::to($user->email)->send(new ForgotPasswordMail($user, $otp));
        }

        return back()->with('status', 'A reset link has been sent to your email (check spam if not visible).');
    }
}