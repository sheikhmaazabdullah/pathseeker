@extends('layouts.app')

@section('title', 'Bookmarks - PathSeeker')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card border-0 shadow-lg bg-gradient-primary text-white rounded-3 p-4 mb-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="display-4 fw-bold">Your Bookmarks, {{ isset($user) ? $user->name : 'Guest' }}!</h1>
                        <p class="lead">Explore and manage your saved careers, resources, and videos.</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <i class="fas fa-bookmark fa-5x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow">
                <div class="card-header bg-transparent">
                    <h5 class="mb-0">Your Bookmarks</h5>
                </div>
                <div class="card-body">
                    @if($bookmarks->isEmpty())
                        <div class="alert alert-info text-center">
                            <i class="fas fa-bookmark fa-2x mb-2"></i>
                            <h5>No Bookmarks Yet</h5>
                            <p>Start exploring and bookmark your favorite content!</p>
                            <a href="{{ route('graduate.dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
                        </div>
                    @else
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            @foreach($bookmarks as $bookmark)
                                <div class="col">
                                    <div class="card h-100 shadow-sm border-0 hover-shadow">
                                        <div class="card-body">
                                            <h6 class="card-title text-primary">{{ $bookmark->bookmarkable->title ?? $bookmark->bookmarkable->name }}</h6>
                                            <p class="card-text small">{{ Str::limit($bookmark->bookmarkable->description ?? '', 100) }}</p>
                                            @if($bookmark->bookmarkable_type === 'App\Models\Career')
                                                <ul class="list-unstyled small">
                                                    <li><i class="fas fa-dollar-sign text-success"></i> Salary: ${{ number_format($bookmark->bookmarkable->expected_salary ?? 0) }}</li>
                                                    <li><i class="fas fa-chart-bar text-info"></i> Demand: {{ ucfirst($bookmark->bookmarkable->demand_level ?? 'High') }}</li>
                                                </ul>
                                            @elseif($bookmark->bookmarkable_type === 'App\Models\Video')
                                                <p class="small text-muted"><i class="fas fa-play-circle"></i> Duration: {{ $bookmark->bookmarkable->duration ?? 'N/A' }}</p>
                                            @elseif($bookmark->bookmarkable_type === 'App\Models\Resource')
                                                <p class="small text-muted"><i class="fas fa-file"></i> Type: {{ $bookmark->bookmarkable->type ?? 'PDF' }}</p>
                                            @endif
                                            <a href="{{ route('graduate.bookmarks.remove', $bookmark->id) }}" class="btn btn-outline-danger btn-sm mt-2"><i class="fas fa-trash"></i> Remove</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
.hover-shadow:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // No share button functionality needed anymore
});
</script>
@endsection