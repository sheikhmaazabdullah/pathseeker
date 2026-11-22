@extends('layouts.dashboard')
@section('title', 'Add Quiz - PathSeeker')
@section('content')
<div class="admin-add-quiz">
    <h2>Add New Quiz</h2>
    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
    <form method="POST" action="{{ route('admin.store-quiz') }}">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <input type="text" name="category" id="category" class="form-control" value="{{ old('category') }}" required>
        </div>
        <div class="form-group">
            <label for="focus_user_type">Focus User Type</label>
            <select name="focus_user_type" id="focus_user_type" class="form-control">
                <option value="">Select Type</option>
                <option value="student" {{ old('focus_user_type') == 'student' ? 'selected' : '' }}>Student</option>
                <option value="graduate" {{ old('focus_user_type') == 'graduate' ? 'selected' : '' }}>Graduate</option>
                <option value="professional" {{ old('focus_user_type') == 'professional' ? 'selected' : '' }}>Professional</option>
            </select>
        </div>
        <div class="form-group">
            <label for="scoring_logic">Scoring Logic (JSON, e.g., {"correct": 10, "incorrect": -2})</label>
            <textarea name="scoring_logic" id="scoring_logic" class="form-control">{{ old('scoring_logic') }}</textarea>
        </div>
        <div class="form-group">
            <label>Questions</label>
            <div id="questions-container">
                <div class="question-row">
                    <div class="form-group">
                        <label for="questions[0][text]">Question Text</label>
                        <input type="text" name="questions[0][text]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="questions[0][options]">Options (JSON, e.g., ["Yes", "No"])</label>
                        <input type="text" name="questions[0][options]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="questions[0][answer]">Answer</label>
                        <input type="text" name="questions[0][answer]" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="questions[0][weight]">Weight</label>
                        <input type="number" name="questions[0][weight]" class="form-control" value="10" min="1">
                    </div>
                </div>
            </div>
            <button type="button" id="add-question" class="btn btn-secondary mt-2">Add Question</button>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Add Quiz</button>
    </form>
</div>
<script>
    document.getElementById('add-question').addEventListener('click', function() {
        const container = document.getElementById('questions-container');
        const index = container.getElementsByClassName('question-row').length;
        const newQuestion = `
            <div class="question-row mt-3">
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