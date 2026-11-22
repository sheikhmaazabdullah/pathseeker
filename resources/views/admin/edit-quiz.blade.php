@extends('layouts.dashboard')

@section('title', 'Edit Quiz - PathSeeker')

@section('content')
<div class="card">
    <h5 class="card-header">Edit Quiz</h5>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.update-quiz', $quiz->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $quiz->title) }}" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" name="category" id="category" class="form-control" value="{{ old('category', $quiz->category) }}" required>
            </div>
            <div class="mb-3">
                <label for="focus_user_type" class="form-label">Focus User Type</label>
                <select name="focus_user_type" id="focus_user_type" class="form-control">
                    <option value="">Select Type</option>
                    <option value="student" {{ old('focus_user_type', $quiz->focus_user_type) == 'student' ? 'selected' : '' }}>Student</option>
                    <option value="graduate" {{ old('focus_user_type', $quiz->focus_user_type) == 'graduate' ? 'selected' : '' }}>Graduate</option>
                    <option value="professional" {{ old('focus_user_type', $quiz->focus_user_type) == 'professional' ? 'selected' : '' }}>Professional</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="scoring_logic" class="form-label">Scoring Logic (JSON)</label>
                <textarea name="scoring_logic" id="scoring_logic" class="form-control">{{ old('scoring_logic', json_encode($quiz->scoring_logic ?? [])) }}</textarea>
            </div>
            <div class="mb-3">
                <label>Questions</label>
                <div id="questions-container">
                    @foreach ($quiz->questions as $index => $question)
                        <div class="question-row mt-3">
                            <input type="hidden" name="questions[{{ $index }}][id]" value="{{ $question->id }}">
                            <div class="form-group">
                                <label for="questions[{{ $index }}][text]">Question Text</label>
                                <input type="text" name="questions[{{ $index }}][text]" class="form-control" value="{{ old("questions.$index.text", $question->text) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="questions[{{ $index }}][options]">Options (JSON)</label>
                                <input type="text" name="questions[{{ $index }}][options]" class="form-control" value="{{ old("questions.$index.options", json_encode($question->options)) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="questions[{{ $index }}][answer]">Answer</label>
                                <input type="text" name="questions[{{ $index }}][answer]" class="form-control" value="{{ old("questions.$index.answer", $question->answer) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="questions[{{ $index }}][weight]">Weight</label>
                                <input type="number" name="questions[{{ $index }}][weight]" class="form-control" value="{{ old("questions.$index.weight", $question->weight) }}" min="1">
                            </div>
                            <button type="button" class="btn btn-danger mt-2 remove-question">Remove</button>
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-question" class="btn btn-secondary mt-2">Add Question</button>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Update Quiz</button>
            <a href="{{ route('admin.quizzes') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
<script>
    document.getElementById('add-question').addEventListener('click', function() {
        const container = document.getElementById('questions-container');
        const index = container.getElementsByClassName('question-row').length;
        const newQuestion = `
            <div class="question-row mt-3">
                <input type="hidden" name="questions[${index}][id]" value="">
                <div class="form-group">
                    <label for="questions[${index}][text]">Question Text</label>
                    <input type="text" name="questions[${index}][text]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="questions[${index}][options]">Options (JSON)</label>
                    <input type="text" name="questions[${index}][options]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="questions[${index}][answer]">Answer</label>
                    <input type="text" name="questions[${index}][answer]" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="questions[${index}][weight]">Weight</label>
                    <input type="number" name="questions[${index}][weight]" class="form-control" value="10" min="1">
                </div>
                <button type="button" class="btn btn-danger mt-2 remove-question">Remove</button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', newQuestion);
        container.querySelectorAll('.remove-question').forEach(button => {
            button.addEventListener('click', function() {
                this.parentElement.remove();
            });
        });
    });
</script>
@endsection