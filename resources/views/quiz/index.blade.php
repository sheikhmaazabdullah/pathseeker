@extends('layouts.app')

@section('title', 'Take a Quiz - PathSeeker')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title mb-4">Available Quizzes</h2>
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif
                <div class="row">
                    @foreach ($quizzes as $quiz)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm border-0">
                                <div class="card-body text-center">
                                    <h5 class="card-title">{{ $quiz->title }}</h5>
                                    <p class="card-text text-muted">Category: {{ $quiz->category }}</p>
                                    <p class="card-text text-muted">For: {{ $quiz->focus_user_type ?: 'All Users' }}</p>
                                    <a href="{{ route('quiz.show', $quiz->id) }}" class="btn btn-primary btn-sm">Start Quiz</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection