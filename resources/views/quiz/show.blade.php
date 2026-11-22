@extends('layouts.app')

@section('title', "Quiz: {$quiz->title} - PathSeeker")

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title mb-4">{{ $quiz->title }}</h2>
                <p class="text-muted">Category: {{ $quiz->category }} | Questions: {{ $quiz->questions->count() }}</p>
                <form action="{{ route('quiz.submit', $quiz->id) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    <div class="progress mb-4" style="height: 10px;">
                        <div class="progress-bar bg-primary" id="progress-bar" style="width: 0%;" role="progressbar"></div>
                    </div>
                    @foreach ($quiz->questions as $index => $question)
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">Question {{ $index + 1 }}</h5>
                                <p class="card-text">{{ $question->text }}</p>
                                @php
                                    $options = is_array($question->options) ? $question->options : [$question->options];
                                @endphp
                                @foreach ($options as $option)
                                    <div class="form-check mb-2">
                                        <input type="radio" name="answers[{{ $question->id }}]" value="{{ $option }}" class="form-check-input" id="option_{{ $question->id }}_{{ $loop->index }}" required>
                                        <label class="form-check-label" for="option_{{ $question->id }}_{{ $loop->index }}">{{ $option }}</label>
                                    </div>
                                @endforeach
                                <div class="invalid-feedback">Please select an answer.</div>
                            </div>
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary btn-lg">Submit Quiz</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const progressBar = document.getElementById('progress-bar');
        const totalQuestions = {{ $quiz->questions->count() }};
        let currentQuestion = 0;

        form.addEventListener('change', function(e) {
            if (e.target.type === 'radio') {
                currentQuestion = document.querySelectorAll('input[type="radio"]:checked').length;
                const progress = (currentQuestion / totalQuestions) * 100;
                progressBar.style.width = `${progress}%`;
            }
        });

        form.addEventListener('submit', function(e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });
</script>
@endsection