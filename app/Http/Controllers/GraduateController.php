<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\Quiz;
use App\Models\Bookmark;
use App\Models\QuizAttempt;
use App\Models\Multimedia;
use App\Models\Feedback;
use App\Models\SuccessStory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class GraduateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {
        $user = Auth::user();

        try {
            Log::info('Starting dashboard load for user ' . $user->id);
            $careerMatches = $this->getRecommendedCareers($user);
            $quizzes = Quiz::take(5)->get();
            $bookmarks = collect();
            try {
                $bookmarks = Bookmark::where('user_id', $user->id)
                    ->with(['multimedia', 'successStory', 'career'])
                    ->get();
                Log::info('Bookmarks fetched: ' . $bookmarks->count());
            } catch (Exception $e) {
                Log::error('Bookmarks fetch failed: ' . $e->getMessage());
            }
            $quizAttempts = QuizAttempt::where('user_id', $user->id)
                ->with('quiz')
                ->orderBy('created_at', 'desc')
                ->get();
            $resources = Multimedia::whereIn('type', ['pdf', 'image'])->take(5)->get();
            $pendingFeedback = Feedback::where('user_id', $user->id)
                ->where('status', 'pending')
                ->count();

            Log::info('Dashboard data prepared for user ' . $user->id);
            return view('graduate.dashboard', compact(
                'user', 'careerMatches', 'quizzes', 'bookmarks',
                'quizAttempts', 'resources', 'pendingFeedback'
            ));
        } catch (Exception $e) {
            Log::error('Dashboard error for user ' . $user->id . ': ' . $e->getMessage());
            return redirect()->route('graduate.dashboard')->with('error', str_replace("\n", ' ', 'An error occurred. Please try again.'));
        }
    }

    protected function getRecommendedCareers($user)
    {
        $careerMatches = Career::orderBy('demand_level', 'desc')
                             ->take(6)
                             ->get();

        $quizAttempts = QuizAttempt::where('user_id', $user->id)->with('quiz')->get();
        if ($quizAttempts->isNotEmpty()) {
            $interestedDomains = $quizAttempts->pluck('quiz.domain')->unique();
            $careerMatches = Career::whereIn('domain', $interestedDomains)
                                ->orderBy('demand_level', 'desc')
                                ->take(6)
                                ->get();
        }

        return $careerMatches;
    }

    public function viewCareers(Request $request)
    {
        $query = Career::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('domain', 'like', '%' . $search . '%')
                  ->orWhereRaw('JSON_SEARCH(requirements, "one", ?) IS NOT NULL', [$search]);
            });
        }

        if ($request->filled('domain')) {
            $query->where('domain', $request->domain);
        }

        if ($request->filled('demand_level')) {
            $query->where('demand_level', $request->demand_level);
        }

        $careers = $query->get();
        $domains = Career::distinct()->pluck('domain');
        $demandLevels = ['high', 'medium', 'low'];

        return view('graduate.careers', compact('careers', 'domains', 'demandLevels'));
    }

    public function careerSearchSuggestions(Request $request)
    {
        $term = $request->get('term', '');
        $suggestions = Career::where('title', 'like', '%' . $term . '%')
            ->orWhere('domain', 'like', '%' . $term . '%')
            ->limit(10)
            ->pluck('title');

        return response()->json($suggestions);
    }

    public function showQuizList()
    {
        $quizzes = Quiz::all();
        return view('graduate.quizzes', compact('quizzes'));
    }

    public function takeQuiz($id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);
        return view('graduate.take-quiz', compact('quiz'));
    }

    public function submitQuiz(Request $request, $id)
    {
        $quiz = Quiz::with('questions')->findOrFail($id);
        $user = Auth::user();
        $score = 0;
        $totalWeight = $quiz->questions->sum('weight');

        foreach ($quiz->questions as $question) {
            $userAnswer = $request->input('question_' . $question->id);
            if ($userAnswer === $question->answer) {
                $score += $question->weight ?? 10;
            }
        }

        $percentage = ($totalWeight > 0) ? round(($score / $totalWeight) * 100, 2) : 0;

        QuizAttempt::create([
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
            'score' => $score,
            'completed_at' => now(),
            'responses' => json_encode($request->all()),
        ]);

        return redirect()->route('graduate.dashboard')->with('success', str_replace("\n", ' ', 'Quiz submitted! Score: ' . $percentage . '%'));
    }

    public function viewMultimedia(Request $request)
    {
        $query = Multimedia::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhereRaw('JSON_SEARCH(tags, "one", ?) IS NOT NULL', [$search]);
            });
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $multimedia = $query->get();
        $types = Multimedia::distinct()->pluck('type');

        return view('graduate.multimedia', compact('multimedia', 'types'));
    }

    public function rateMultimedia(Request $request, $id)
    {
        try {
            $multimedia = Multimedia::findOrFail($id);
            $rating = $request->rating;
            $value = ($rating === 'up') ? 1 : 0;

            $currentCount = $multimedia->download_count ?? 0;
            $currentAvg = $multimedia->avg_rating ?? 0;
            $newAvg = (($currentAvg * $currentCount) + $value) / ($currentCount + 1);

            $multimedia->update([
                'avg_rating' => round($newAvg, 2),
                'download_count' => $currentCount + 1,
            ]);

            return response()->json(['success' => true, 'new_rating' => $newAvg]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function viewStories(Request $request)
    {
        $query = SuccessStory::where('status', 'approved');

        if ($request->filled('domain')) {
            $query->where('domain', $request->domain);
        }

        $stories = $query->get();
        $domains = SuccessStory::where('status', 'approved')->distinct()->pluck('domain');

        return view('graduate.stories', compact('stories', 'domains'));
    }

    public function submitStory(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'story_text' => 'required|string',
            'timeline' => 'nullable|json',
            'domain' => 'required|string',
        ]);

        SuccessStory::create([
            'title' => $request->title,
            'domain' => $request->domain,
            'story_text' => $request->story_text,
            'timeline' => $request->timeline,
            'user_id' => Auth::id(),
            'status' => 'pending',
        ]);

        return redirect()->route('graduate.stories')->with('success', str_replace("\n", ' ', 'Story submitted for approval.'));
    }

    public function viewResources(Request $request)
    {
        $query = Multimedia::whereIn('type', ['pdf', 'image']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhereRaw('JSON_SEARCH(tags, "one", ?) IS NOT NULL', [$search]);
            });
        }

        if ($request->filled('tag')) {
            $query->whereRaw('JSON_SEARCH(tags, "one", ?) IS NOT NULL', [$request->tag]);
        }

        $resources = $query->get();
        $tags = Multimedia::whereIn('type', ['pdf', 'image'])
            ->get()
            ->flatMap(function ($item) {
                return json_decode($item->tags ?? '[]', true) ?? [];
            })
            ->unique();

        return view('graduate.resources', compact('resources', 'tags'));
    }

    public function downloadResource($id)
    {
        try {
            $resource = Multimedia::findOrFail($id);
            $resource->increment('download_count');

            $fullPath = storage_path('app/public' . $resource->file_path);

            if (file_exists($fullPath)) {
                return response()->download($fullPath, $resource->title . '.' . $resource->type);
            }

            return redirect()->route('graduate.resources')->with('error', str_replace("\n", ' ', 'File not found.'));
        } catch (Exception $e) {
            return redirect()->route('graduate.resources')->with('error', str_replace("\n", ' ', 'Download failed: ' . $e->getMessage()));
        }
    }

    public function submitFeedback(Request $request)
    {
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
                return redirect()->route('graduate.dashboard')->with('success', str_replace("\n", ' ', 'Feedback submitted successfully.'));
            } else {
                Log::error('Failed to create feedback record for user ID: ' . Auth::id());
                return redirect()->back()->with('error', str_replace("\n", ' ', 'Failed to submit feedback. Please try again.'));
            }
        } catch (\Exception $e) {
            Log::error('Error in submitFeedback: ' . $e->getMessage());
            return redirect()->back()->with('error', str_replace("\n", ' ', 'An error occurred. Please try again later.'));
        }
    }

    public function feedback()
    {
        $user = Auth::user();
        $feedback = Feedback::where('user_id', $user->id)->get();
        return view('graduate.feedback', compact('feedback', 'user'));
    }

    public function saveBookmark(Request $request)
    {
        try {
            $request->validate([
                'content_id' => 'required|integer',
                'content_type' => 'required|in:career,multimedia,success_story',
            ]);

            $user = Auth::user();
            $contentType = 'App\\Models\\' . ucfirst(str_replace('_', '', $request->content_type));
            $exists = Bookmark::where('user_id', $user->id)
                             ->where('bookmarkable_id', $request->content_id)
                             ->where('bookmarkable_type', $contentType)
                             ->exists();

            if (!$exists) {
                Bookmark::create([
                    'user_id' => $user->id,
                    'bookmarkable_id' => $request->content_id,
                    'bookmarkable_type' => $contentType,
                    'notes' => $request->notes ?? null,
                ]);

                return response()->json(['success' => true]);
            }

            return response()->json(['success' => false, 'message' => 'Already bookmarked']);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function bookmarks()
    {
        $bookmarks = Bookmark::where('user_id', Auth::id())
            ->with(['career', 'multimedia', 'successStory'])
            ->get();

        return view('graduate.bookmarks', compact('bookmarks'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        return view('graduate.edit-profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        if (!$user || !($user instanceof \App\Models\User)) {
            return redirect()->route('graduate.profile')->with('error', 'User not found or invalid.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'education' => 'nullable|string',
            'skills' => 'nullable|string',
            'interests' => 'nullable|string',
            'work_experience' => 'nullable|string',
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = $request->only(['name', 'email', 'education', 'work_experience']);

        if ($request->filled('skills')) {
            $skillsArray = array_map('trim', explode(',', $request->skills));
            $skillsArray = array_filter($skillsArray, function($skill) { return !empty($skill); });
            $data['skills'] = json_encode($skillsArray);
        }

        if ($request->filled('interests')) {
            $interestsArray = array_map('trim', explode(',', $request->interests));
            $interestsArray = array_filter($interestsArray, function($interest) { return !empty($interest); });
            $data['interests'] = json_encode($interestsArray);
        }

        if ($request->hasFile('resume')) {
            if ($user->resume_path) {
                Storage::delete($user->resume_path);
            }
            $path = $request->file('resume')->store('resumes', 'public');
            $data['resume_path'] = $path;
        }

        // Explicitly update the user
        $user->fill($data)->save();

        return redirect()->route('graduate.profile')->with('success', 'Profile updated successfully.');
    }

    public function getRelated($type, $id)
    {
        try {
            if ($type === 'multimedia') {
                $item = Multimedia::findOrFail($id);
                $tags = json_decode($item->tags ?? '[]', true);
                $related = Multimedia::whereRaw('JSON_OVERLAPS(tags, ?)', [json_encode($tags)])
                    ->where('id', '!=', $id)
                    ->limit(3)
                    ->get();
            } elseif ($type === 'success_story') {
                $item = SuccessStory::findOrFail($id);
                $related = SuccessStory::where('domain', $item->domain)
                    ->where('status', 'approved')
                    ->where('id', '!=', $id)
                    ->limit(3)
                    ->get();
            } else {
                $related = collect();
            }

            return response()->json($related);
        } catch (Exception $e) {
            return response()->json(collect(), 500);
        }
    }
}