<?php

namespace App\Http\Controllers;

use App\Models\Career;
use App\Models\CareerRecommendation;
use App\Models\Quiz;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CareerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of careers with search and filter options.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $query = Career::query();

        // Apply search filter
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('domain', 'like', "%{$search}%")
                  ->orWhere('requirements', 'like', "%{$search}%");
            });
        }

        // Apply domain filter
        if ($domain = $request->input('domain')) {
            $query->where('domain', $domain);
        }

        // Apply salary filter
        if ($salaryMin = $request->input('salary_min')) {
            $query->where('salary', '>=', $salaryMin);
        }

        // Apply demand level filter
        if ($demandLevel = $request->input('demand_level')) {
            $query->where('demand_level', $demandLevel);
        }

        $careers = $query->paginate(6);
        $domains = Career::distinct()->pluck('domain')->toArray();
        $demandLevels = ['low', 'medium', 'high'];

        return view('career.index', compact('careers', 'domains', 'demandLevels', 'user'));
    }

    /**
     * Display the specified career's details.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $career = Career::findOrFail($id);
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Get related careers (same domain or overlapping skills)
        $relatedCareers = Career::where('id', '!=', $career->id)
            ->where(function ($query) use ($career) {
                $query->where('domain', $career->domain)
                      ->orWhereJsonContains('requirements->skills', $career->requirements['skills'] ?? []);
            })
            ->take(3)
            ->get();

        // Get recommendation data
        $recommendation = CareerRecommendation::where('career_id', $career->id)->first();
        $minPercentage = $recommendation ? $recommendation->min_percentage : 70;

        // Find related quiz
        $quiz = Quiz::where('category', $recommendation->quiz_category ?? 'General')->first();

        // Add domains and demand levels for search filter
        $domains = Career::distinct()->pluck('domain')->toArray();
        $demandLevels = ['low', 'medium', 'high'];

        return view('career.show', compact('career', 'relatedCareers', 'minPercentage', 'quiz', 'user', 'domains', 'demandLevels'));
    }

    /**
     * Provide autocomplete suggestions for career search.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchSuggestions(Request $request)
    {
        $term = $request->input('term');
        $suggestions = Career::where('title', 'like', "%{$term}%")
            ->orWhere('domain', 'like', "%{$term}%")
            ->orWhere('requirements', 'like', "%{$term}%")
            ->pluck('title')
            ->take(10)
            ->toArray();
        return response()->json($suggestions);
    }

    /**
     * Save user preferences for career filters.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function savePreferences(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $preferences = $user->preferences ?? [];
        $preferences['search'] = $request->input('search', $preferences['search'] ?? '');
        $preferences['domain'] = $request->input('domain', $preferences['domain'] ?? '');
        $preferences['salary_min'] = $request->input('salary_min', $preferences['salary_min'] ?? '');
        $preferences['demand_level'] = $request->input('demand_level', $preferences['demand_level'] ?? '');
        $user->update(['preferences' => $preferences]);

        return response()->json(['success' => true]);
    }

    /**
     * Save a bookmark for a career.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveBookmark(Request $request)
    {
        $request->validate([
            'bookmarkable_id' => 'required|exists:careers,id',
            'bookmarkable_type' => 'required|in:App\Models\Career',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();
        $existingBookmark = $user->bookmarks()->where('bookmarkable_id', $request->bookmarkable_id)
            ->where('bookmarkable_type', $request->bookmarkable_type)
            ->first();

        if (!$existingBookmark) {
            $user->bookmarks()->create([
                'bookmarkable_id' => $request->bookmarkable_id,
                'bookmarkable_type' => $request->bookmarkable_type,
                'note' => $request->input('note', null),
            ]);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Already bookmarked']);
    }
}