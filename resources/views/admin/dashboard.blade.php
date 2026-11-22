@extends('layouts.dashboard')

@section('title', 'Admin Dashboard - PathSeeker')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title mb-4">Welcome, {{ Auth::user()->name }}</h2>
                <div class="row">
                    <div class="col-md-3 col-sm-6 grid-margin stretch-card">
                        <div class="card bg-primary text-white">
                            <div class="card-body">
                                <h4 class="card-title">Total Users</h4>
                                <h2 class="text-white">{{ $stats['total_users'] }}</h2>
                                <p>Active: {{ $stats['active_users'] }}</p>
                                <a href="{{ route('admin.users') }}" class="btn btn-light btn-sm">Manage</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 grid-margin stretch-card">
                        <div class="card bg-success text-white">
                            <div class="card-body">
                                <h4 class="card-title">Quiz Attempts</h4>
                                <h2 class="text-white">{{ $stats['quiz_attempts'] }}</h2>
                                <a href="{{ route('admin.quizzes') }}" class="btn btn-light btn-sm">Manage</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 grid-margin stretch-card">
                        <div class="card bg-warning text-white">
                            <div class="card-body">
                                <h4 class="card-title">Popular Content</h4>
                                <h2 class="text-white">{{ $stats['popular_content']->count() }}</h2>
                                <a href="{{ route('admin.multimedia') }}" class="btn btn-light btn-sm">View Top</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 grid-margin stretch-card">
                        <div class="card bg-purple text-white">
                            <div class="card-body">
                                <h4 class="card-title">Pending Users</h4>
                                <h2 class="text-white">{{ $stats['pending_users'] }}</h2>
                                <a href="{{ route('admin.usersequests') }}" class="btn btn-light btn-sm">Review</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 grid-margin stretch-card">
                        <div class="card bg-info text-white">
                            <div class="card-body">
                                <h4 class="card-title">Success Stories</h4>
                                <h2 class="text-white">{{ $stats['success_stories'] }}</h2>
                                <a href="{{ route('admin.success-stories') }}" class="btn btn-light btn-sm">Manage</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 grid-margin stretch-card">
                        <div class="card bg-danger text-white">
                            <div class="card-body">
                                <h4 class="card-title">Pending Feedback</h4>
                                <h2 class="text-white">{{ $stats['pending_feedback'] }}</h2>
                                <a href="{{ route('admin.feedback') }}" class="btn btn-light btn-sm">Review</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity Section -->
                <div class="row mt-4">
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Recent Activity</h4>
                                <div class="row">
                                    <!-- Recent User Activity -->
                                    <div class="col-md-4">
                                        <h5 class="mb-3">User Activity (Last 7 Days)</h5>
                                        @if($stats['user_activity']->isEmpty())
                                            <p class="text-muted">No user activity in the last 7 days.</p>
                                        @else
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>New Users</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($stats['user_activity'] as $activity)
                                                        <tr>
                                                            <td>{{ \Carbon\Carbon::parse($activity->date)->format('M d, Y') }}</td>
                                                            <td>{{ $activity->count }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                    </div>

                                    <!-- Recent Quiz Attempts -->
                                    <div class="col-md-4">
                                        <h5 class="mb-3">Recent Quiz Attempts</h5>
                                        @if($stats['recent_quiz_attempts']->isEmpty())
                                            <p class="text-muted">No recent quiz attempts.</p>
                                        @else
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Quiz</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($stats['recent_quiz_attempts'] as $attempt)
                                                        <tr>
                                                            <td>{{ $attempt->quiz->title ?? 'Unknown Quiz' }}</td>
                                                            <td>{{ $attempt->created_at->format('M d, Y H:i') }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                    </div>

                                    <!-- Pending Feedback -->
                                    <div class="col-md-4">
                                        <h5 class="mb-3">Pending Feedback</h5>
                                        @if($stats['recent_feedback']->isEmpty())
                                            <p class="text-muted">No pending feedback.</p>
                                        @else
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>User</th>
                                                        <th>Type</th>
                                                        <th>Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($stats['recent_feedback'] as $feedback)
                                                        <tr>
                                                            <td>{{ $feedback->user->name ?? 'Unknown User' }}</td>
                                                            <td>{{ ucfirst($feedback->type) }}</td>
                                                            <td>{{ $feedback->created_at->format('M d, Y H:i') }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="row mt-4">
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Quick Actions</h4>
                                <div class="row">
                                    <div class="col-md-2"><a href="{{ route('admin.add-user') }}" class="btn btn-primary btn-block">Add User</a></div>
                                    <div class="col-md-2"><a href="{{ route('admin.add-career') }}" class="btn btn-success btn-block">Add Career</a></div>
                                    <div class="col-md-2"><a href="{{ route('admin.add-quiz') }}" class="btn btn-info btn-block">Add Quiz</a></div>
                                    <div class="col-md-2"><a href="{{ route('admin.upload-content') }}" class="btn btn-warning btn-block">Upload Content</a></div>
                                    <div class="col-md-2"><a href="{{ route('admin.success-stories') }}" class="btn btn-secondary btn-block">Manage Stories</a></div>
                                    <div class="col-md-2"><a href="{{ route('admin.feedback') }}" class="btn btn-danger btn-block">Manage Feedback</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Status -->
                <div class="row mt-4">
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">System Status</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <p><strong>Environment:</strong> {{ config('app.env') }}</p>
                                        <p><strong>Debug Mode:</strong> {{ config('app.debug') ? 'Enabled' : 'Disabled' }}</p>
                                        <p><strong>PHP Version:</strong> {{ phpversion() }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Laravel Version:</strong> {{ \Illuminate\Foundation\Application::VERSION }}</p>
                                        <p><strong>Database:</strong> {{ config('database.default') }}</p>
                                        <p><strong>Server Time:</strong> {{ now()->format('M d, Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection