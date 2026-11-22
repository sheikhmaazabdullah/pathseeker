@extends('layouts.app')

@section('title', 'Graduate Dashboard - PathSeeker')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card border-0 shadow-lg bg-gradient-primary text-white rounded-3 p-4 mb-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="display-4 fw-bold">Welcome Back, {{ $user->name }}!</h1>
                        <p class="lead">Discover your career path with personalized guidance. Your recent activity: {{ $quizAttempts->count() }} quizzes completed.</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <i class="fas fa-graduation-cap fa-5x opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Trending Careers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $careerMatches->count() }}</div>
                            <div class="text-xs text-muted">Based on current job market trends</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <a href="{{ route('career.index') }}" class="btn btn-primary btn-sm mt-2">Explore Trends</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Top Picks for You</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $resources->count() }}</div>
                            <div class="text-xs text-muted">Personalized resources</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-star fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <a href="{{ route('graduate.resources') }}" class="btn btn-success btn-sm mt-2">View Picks</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Recent Activity</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $quizAttempts->count() }}</div>
                            <div class="text-xs text-muted">Quiz attempts & bookmarks</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-history fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <a href="{{ route('graduate.bookmarks') }}" class="btn btn-info btn-sm mt-2">View History</a>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Feedback</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingFeedback }}</div>
                            <div class="text-xs text-muted">Responses awaiting</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comment-dots fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <a href="{{ route('graduate.feedback') }}" class="btn btn-warning btn-sm mt-2">Check Responses</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow">
                <div class="card-header bg-transparent">
                    <h5 class="mb-0">Recommended Careers <small class="text-muted">(Based on Your Interests & Quiz Results)</small></h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse($careerMatches as $career)
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="card h-100 shadow-sm border-0 hover-shadow">
                                    <div class="card-body">
                                        <h6 class="card-title text-primary">{{ $career->title }}</h6>
                                        <p class="card-text small">{{ Str::limit($career->description, 100) }}</p>
                                        <ul class="list-unstyled small">
                                            <li><i class="fas fa-dollar-sign text-success"></i> Salary: ${{ number_format($career->expected_salary ?? 0, 2) }}</li>
                                            <li><i class="fas fa-chart-bar text-info"></i> Demand: {{ ucfirst($career->demand_level ?? 'Unknown') }}</li>
                                            <li><i class="fas fa-globe text-warning"></i> Domain: {{ $career->domain ?? 'N/A' }}</li>
                                        </ul>
                                        <a href="{{ route('career.show', $career->id) }}" class="btn btn-outline-primary btn-sm">View Details <i class="fas fa-arrow-right"></i></a>
                                        <button class="btn btn-outline-secondary btn-sm bookmark-btn" data-id="{{ $career->id }}" data-type="career">
                                            <i class="far fa-bookmark"></i> Bookmark
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info text-center">
                                    <i class="fas fa-lightbulb fa-2x mb-2"></i>
                                    <h5>No Recommendations Yet</h5>
                                    <p>Take an interest quiz to unlock personalized career suggestions!</p>
                                    <a href="{{ route('quiz.index') }}" class="btn btn-primary">Start Quiz</a>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow">
                <div class="card-header bg-transparent">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <a href="{{ route('graduate.profile') }}" class="text-decoration-none">
                                <div class="card border-0 text-center p-3 hover-card">
                                    <i class="fas fa-user-edit fa-3x text-primary mb-2"></i>
                                    <h6>Profile Management</h6>
                                    <small class="text-muted">Edit education, skills & resume upload</small>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3">
                            <a href="{{ route('quiz.index') }}" class="text-decoration-none">
                                <div class="card border-0 text-center p-3 hover-card">
                                    <i class="fas fa-question-circle fa-3x text-success mb-2"></i>
                                    <h6>Interest Quiz</h6>
                                    <small class="text-muted">AI-powered multi-step quiz with trends</small>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3">
                            <a href="{{ route('career.index') }}" class="text-decoration-none">
                                <div class="card border-0 text-center p-3 hover-card">
                                    <i class="fas fa-briefcase fa-3x text-info mb-2"></i>
                                    <h6>Career Bank</h6>
                                    <small class="text-muted">Advanced filters & smart search</small>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3">
                            <a href="{{ route('graduate.multimedia') }}" class="text-decoration-none">
                                <div class="card border-0 text-center p-3 hover-card">
                                    <i class="fas fa-video fa-3x text-warning mb-2"></i>
                                    <h6>Multimedia Center</h6>
                                    <small class="text-muted">Videos, podcasts with ratings & transcripts</small>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3">
                            <a href="{{ route('graduate.stories') }}" class="text-decoration-none">
                                <div class="card border-0 text-center p-3 hover-card">
                                    <i class="fas fa-trophy fa-3x text-danger mb-2"></i>
                                    <h6>Success Stories</h6>
                                    <small class="text-muted">Inspiring journeys with filtering</small>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3">
                            <a href="{{ route('graduate.bookmarks') }}" class="text-decoration-none">
                                <div class="card border-0 text-center p-3 hover-card">
                                    <i class="fas fa-bookmark fa-3x text-dark mb-2"></i>
                                    <h6>Bookmarks & Notes</h6>
                                    <small class="text-muted">Save, add notes & export as PDF</small>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-3">
                            <a href="{{ route('graduate.feedback') }}" class="text-decoration-none">
                                <div class="card border-0 text-center p-3 hover-card">
                                    <i class="fas fa-comments fa-3x text-muted mb-2"></i>
                                    <h6>Feedback</h6>
                                    <small class="text-muted">Submit & track responses</small>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow">
                <div class="card-header bg-transparent">
                    <h5 class="mb-0">Recent Activity</h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        @forelse($quizAttempts->reverse()->take(5) as $attempt)
                            <div class="timeline-item">
                                <div class="timeline-badge"><i class="fas fa-clipboard-check"></i></div>
                                <div class="timeline-content">
                                    <h6>{{ $attempt->quiz->title }}</h6>
                                    <p>Score: {{ number_format($attempt->percentage ?? 0, 2) }}% - {{ $attempt->created_at->format('M d, Y') }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted">No recent activity. Get started with a quiz!</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
.hover-card:hover {
    transform: translateY(-5px);
    transition: all 0.3s ease;
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}
.hover-shadow:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
}
.timeline {
    position: relative;
    padding-left: 30px;
}
.timeline-item {
    position: relative;
    margin-bottom: 20px;
}
.timeline-badge {
    position: absolute;
    left: -15px;
    top: 5px;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background: #667eea;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
}
.timeline-content h6 {
    margin-bottom: 5px;
    color: #333;
}
.bookmark-btn {
    float: right;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    $('.bookmark-btn').click(function(e) {
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        var type = btn.data('type');
        $.post('{{ route("graduate.bookmarks.save") }}', {
            _token: '{{ csrf_token() }}',
            content_id: id,
            content_type: type
        }, function(data) {
            if (data.success) {
                btn.html('<i class="fas fa-bookmark"></i> Bookmarked');
                btn.prop('disabled', true);
            } else {
                alert(data.message || 'Bookmark failed.');
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            console.error('Bookmark error:', textStatus, errorThrown);
            alert('An error occurred. Check console for details.');
        });
    });
});
</script>
@endsection