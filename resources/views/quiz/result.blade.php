@extends('layouts.app')

@section('title', 'Quiz Result - PathSeeker')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title mb-4">Quiz Result: {{ $attempt->quiz->title }}</h2>
                <p class="lead">Completed by: {{ $user->name }}</p>
                <div class="alert {{ $percentage >= $minPercentage ? 'alert-success' : ($percentage >= $minPercentage * 0.7 ? 'alert-warning' : 'alert-danger') }}">
                    Your Score: {{ $attempt->score }} / {{ $maxScore }} ({{ number_format($percentage, 2) }}%)
                </div>
                <h4 class="mt-4">Recommendations:</h4>
                <ul class="list-group">
                    @foreach ($recommendations as $recommendation)
                        <li class="list-group-item">{{ $recommendation }}</li>
                    @endforeach
                </ul>
                <p>Minimum required for {{ $recommendedCareer }}: {{ number_format($minPercentage, 2) }}%</p>
                <a href="{{ route('quiz.index') }}" class="btn btn-primary mt-4">Take Another Quiz</a>
                <a href="{{ route('professional.dashboard') }}" class="btn btn-secondary mt-4 ml-2">Back to Dashboard</a>
            </div>
        </div>
    </div>
</div>
@endsection