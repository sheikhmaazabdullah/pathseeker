<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = '/home';

    public function __construct()
    {
        // No middleware here to allow access regardless of login status
        // $this->middleware('guest'); // Removed to prevent conflicts
    }

    public function showOtpForm(Request $request)
    {
        return view('auth.passwords.otp', ['email' => $request->query('email')]);
    }

    public function resetWithOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'otp' => 'required|string|min:6|max:6',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        if ($user->otp !== $request->otp) {
            return back()->withErrors(['otp' => 'Invalid OTP.']);
        }

        if ($user->otp_created_at && $user->otp_created_at->diffInMinutes(now()) > 10) {
            return back()->withErrors(['otp' => 'The OTP has expired. Please request a new one.']);
        }

        $user->password = Hash::make($request->password);
        $user->otp = null;
        $user->otp_created_at = null;
        $user->save();

        return redirect($this->redirectTo)->with('status', 'Your password has been reset successfully!');
    }

    // Override default reset form to use OTP flow
    public function showResetForm(Request $request, $token = null)
    {
        // If token is provided, redirect to OTP form with email from session or request
        if ($request->has('email')) {
            return redirect()->route('password.reset.otp', ['email' => $request->query('email')]);
        }
        // Fallback to OTP form if no token is valid
        return redirect()->route('password.reset.otp');
    }
}