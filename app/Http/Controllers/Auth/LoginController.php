<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Get the post-login redirect path.
     *
     * @return string
     */
    protected function redirectTo()
    {
        if (Auth::check()) {
            $user = Auth::user();
            Log::info('Redirecting user ' . $user->id . ' (role: ' . $user->role . ') to ' . ($user->role === 'graduate' ? route('graduate.dashboard') : 'other route'));
            if ($user->role === 'admin') {
                return route('admin.dashboard');
            } elseif ($user->role === 'professional') {
                return route('professional.dashboard');
            } elseif ($user->role === 'graduate') {
                return route('graduate.dashboard');
            }
        }
        return '/home';
    }
}