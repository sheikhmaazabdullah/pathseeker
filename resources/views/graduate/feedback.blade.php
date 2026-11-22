@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Feedback</h2>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Feedback Form -->
        <div class="card p-4 mb-4">
            <h4>Submit New Feedback</h4>
            <form action="{{ route('graduate.submit-feedback') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="type" class="form-label">Feedback Type</label>
                    <select name="type" id="type" class="form-control" required>
                        <option value="bug">Bug</option>
                        <option value="suggestion">Suggestion</option>
                        <option value="query">Query</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea name="message" id="message" class="form-control" rows="4" maxlength="1000" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Feedback</button>
            </form>
        </div>

        <!-- Display Existing Feedback -->
        <div class="card p-4">
            <h4>Your Feedback History</h4>
            @if ($feedback->isEmpty())
                <p>No feedback submitted yet.</p>
            @else
                <ul class="list-group">
                    @foreach ($feedback as $item)
                        <li class="list-group-item">
                            <strong>{{ ucfirst($item->type) }}:</strong> {{ $item->message }}<br>
                            <small>Submitted: {{ $item->created_at->diffForHumans() }}</small>
                            @if ($item->status === 'pending')
                                <span class="badge bg-warning text-dark">Pending</span>
                            @else
                                <span class="badge bg-success">Resolved</span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection