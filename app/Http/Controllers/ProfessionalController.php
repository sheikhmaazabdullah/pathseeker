<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User; // Import the User model
use App\Models\Career;
use App\Models\Quiz;
use App\Models\Multimedia;
use App\Models\SuccessStory;
use App\Models\Feedback;

class ProfessionalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $user = Auth::user();
        
        if ($user->role !== 'professional') {
            return redirect('/dashboard')->with('error', 'Access restricted to professionals.');
        }

        $careers = Career::all();
        $quizzes = Quiz::where('focus_user_type', 'professional')->get();
        $multimedia = Multimedia::all();
        $successStories = SuccessStory::where('status', 'approved')->get();

        $userSkills = json_decode($user->skills ?? '[]', true) ?? [];

        $recommendedCareers = collect();
        if (!empty($userSkills)) {
            $recommendedCareers = Career::whereIn('demand_level', ['high', 'medium'])
                ->where(function ($query) use ($userSkills) {
                    foreach ($userSkills as $skill) {
                        if (is_string($skill) && !empty(trim($skill))) {
                            $query->orWhereRaw('JSON_VALUE(requirements, \'$.skills\') LIKE ? OR requirements LIKE ?', ["%" . trim($skill) . "%", "%" . trim($skill) . "%"]);
                        }
                    }
                })
                ->take(3)
                ->get();
        }

        return view('professional.dashboard', compact('user', 'careers', 'quizzes', 'multimedia', 'successStories', 'recommendedCareers', 'userSkills'));
    }

    public function profile()
    {
        $user = Auth::user();
        if ($user->role !== 'professional') {
            return redirect('/dashboard')->with('error', 'Access restricted to professionals.');
        }
        return view('professional.profile', compact('user'));
    }

    public function showUpdateProfile()
    {
        $user = Auth::user();
        if ($user->role !== 'professional') {
            return redirect('/dashboard')->with('error', 'Access restricted to professionals.');
        }
        return view('professional.update-profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        if ($user->role !== 'professional') {
            return redirect('/dashboard')->with('error', 'Access restricted to professionals.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'education' => 'nullable|string',
            'skills' => 'nullable|string',  // Accept string (comma-separated)
            'interests' => 'nullable|string',  // Accept string (comma-separated)
            'work_experience' => 'nullable|string',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = $request->only(['name', 'email', 'education', 'work_experience']);
        
        // Process skills: Split comma-separated string into array and encode to JSON
        if ($request->filled('skills')) {
            $skillsArray = array_map('trim', explode(',', $request->skills));
            $skillsArray = array_filter($skillsArray, function($skill) { return !empty($skill); });  // Remove empty items
            $data['skills'] = json_encode($skillsArray);
        }
        
        // Process interests: Split comma-separated string into array and encode to JSON
        if ($request->filled('interests')) {
            $interestsArray = array_map('trim', explode(',', $request->interests));
            $interestsArray = array_filter($interestsArray, function($interest) { return !empty($interest); });  // Remove empty items
            $data['interests'] = json_encode($interestsArray);
        }

        if ($request->hasFile('resume')) {
            if ($user->resume_path) {
                Storage::delete($user->resume_path);
            }
            $path = $request->file('resume')->store('resumes', 'public');
            $data['resume_path'] = $path;
        }

        $user->fill($data)->save();

        return redirect()->route('professional.profile')->with('success', 'Profile updated successfully.');
    }

    public function viewStories(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'professional') {
            return redirect('/dashboard')->with('error', 'Access restricted to professionals.');
        }

        $query = SuccessStory::where('status', 'approved');

        if ($request->filled('domain')) {
            $query->where('domain', $request->domain);
        }

        $stories = $query->get();
        $domains = SuccessStory::where('status', 'approved')->distinct()->pluck('domain');

        return view('professional.stories', compact('stories', 'domains'));
    }

    public function submitFeedback(Request $request)
    {
        $user = Auth::user();
        if ($user->role !== 'professional') {
            return redirect('/dashboard')->with('error', 'Access restricted to professionals.');
        }

        try {
            $validatedData = $request->validate([
                'type' => 'required|in:bug,suggestion,query',
                'message' => 'required|string|max:1000',
            ]);

            $feedback = Feedback::create([
                'user_id' => Auth::id(),
                'type' => $validatedData['type'],
                'message' => $validatedData['message'],
                'status' => 'pending',
            ]);

            if ($feedback) {
                return redirect()->route('professional.feedback')->with('success', 'Feedback submitted successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to submit feedback. Please try again.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred. Please try again later.');
        }
    }

    public function feedback()
    {
        $user = Auth::user();
        if ($user->role !== 'professional') {
            return redirect('/dashboard')->with('error', 'Access restricted to professionals.');
        }
        $feedback = Feedback::where('user_id', $user->id)->get();
        return view('professional.feedback', compact('feedback', 'user'));
    }
}