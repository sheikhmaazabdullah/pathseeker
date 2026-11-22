@extends('layouts.dashboard')

@section('title', 'Edit Feedback - PathSeeker')

@section('content')
<div class="card">
    <h5 class="card-header">Edit Feedback</h5>
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
        <form action="{{ route('admin.update-feedback', $feedback->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select name="type" id="type" class="form-control" required>
                    <option value="" disabled>Select Type</option>
                    <option value="bug" {{ old('type', $feedback->type) == 'bug' ? 'selected' : '' }}>Bug</option>
                    <option value="suggestion" {{ old('type', $feedback->type) == 'suggestion' ? 'selected' : '' }}>Suggestion</option>
                    <option value="query" {{ old('type', $feedback->type) == 'query' ? 'selected' : '' }}>Query</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea name="message" id="message" class="form-control" required>{{ old('message', $feedback->message) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="sentiment" class="form-label">Sentiment</label>
                <select name="sentiment" id="sentiment" class="form-control" required>
                    <option value="" disabled>Select Sentiment</option>
                    <option value="positive" {{ old('sentiment', $feedback->sentiment) == 'positive' ? 'selected' : '' }}>Positive</option>
                    <option value="negative" {{ old('sentiment', $feedback->sentiment) == 'negative' ? 'selected' : '' }}>Negative</option>
                    <option value="neutral" {{ old('sentiment', $feedback->sentiment) == 'neutral' ? 'selected' : '' }}>Neutral</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Feedback</button>
            <a href="{{ route('admin.feedback') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection