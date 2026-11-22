@extends('layouts.dashboard')
@section('title', 'View Quiz - PathSeeker')
@section('content')
<div class="card">
    <h5 class="card-header">Quiz Details</h5>
    <div class="card-body">
        <p><strong>Title:</strong> {{ $quiz->title }}</p>
        <p><strong>Category:</strong> {{ $quiz->category }}</p>
        <p><strong>Focus User Type:</strong> {{ $quiz->focus_user_type ?? 'N/A' }}</p>
        <p><strong>Scoring Logic:</strong> 
            @if ($quiz->scoring_logic)
                <pre>{{ $quiz->scoring_logic_string }}</pre>
            @else
                N/A
            @endif
        </p>
        <p><strong>Questions:</strong>
            @if ($quiz->questions->count())
                <ul>
                    @foreach ($quiz->questions as $question)
                        <li>
                            <strong>{{ $question->text }}</strong><br>
                            Options: {{ json_encode($question->options) }}<br>
                            Answer: {{ $question->answer }}<br>
                            Weight: {{ $question->weight }}
                        </li>
                    @endforeach
                </ul>
            @else
                N/A
            @endif
        </p>
        <a href="{{ route('admin.edit-quiz', $quiz->id) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('admin.quizzes') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection