<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'about', 'blog', 'contact', 'destinations', 'guide', 'package', 'service', 'single', 'testimonial']);
    }

    public function index()
    {
        return view('index');
    }

    public function dashboard()
    {
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif (Auth::user()->role === 'professional') {
            return redirect()->route('professional.dashboard');
        } elseif (Auth::user()->role === 'graduate') {
            return redirect()->route('graduate.dashboard');
        }
        return view('index');
    }

    public function about() { return view('about'); }
    public function blog() { return view('blog'); }
    public function contact() { return view('contact'); }
    public function destinations() { return view('destinations'); }
    public function guide() { return view('guide'); }
    public function package() { return view('package'); }
    public function service() { return view('service'); }
    public function single() { return view('single'); }
    public function testimonial() { return view('testimonial'); }
}