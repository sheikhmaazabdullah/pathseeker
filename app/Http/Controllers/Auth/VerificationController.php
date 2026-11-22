<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class VerificationController extends Controller
{
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('auth');
        // Removed $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    public function show(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect($this->redirectPath());
        }
        return view('auth.verify');
    }

    public function resend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('status', 'A new verification OTP has been sent to your email.');
    }

    public function verify(Request $request)
    {
        Log::info('Verifying OTP', ['submitted_otp' => $request->otp, 'user_id' => $request->user()->id, 'stored_otp' => $request->user()->otp]);

        $request->validate(['otp' => 'required|string|min:6|max:6']);

        $user = $request->user();
        if (!$user || $user->otp !== $request->otp) {
            Log::error('OTP mismatch', ['user_id' => $user->id, 'submitted' => $request->otp, 'stored' => $user->otp]);
            return back()->withErrors(['otp' => 'Invalid OTP.']);
        }

        if ($user->otp_created_at && $user->otp_created_at->diffInMinutes(now()) > 10) {
            return back()->withErrors(['otp' => 'The OTP has expired. Please request a new one.']);
        }

        $user->email_verified_at = now();
        $user->otp = null;
        $user->otp_created_at = null;
        $user->save();

        return redirect($this->redirectPath())->with('verified', 'Email verified successfully. Awaiting admin approval.');
    }

    protected function redirectPath()
    {
        return '/dashboard'; // Adjust as needed
    }
}