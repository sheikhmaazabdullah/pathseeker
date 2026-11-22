@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h2>Feedback Confirmation</h2>
        <div class="card p-4">
            <p>Thank you for your feedback!</p>
            <p><strong>Type:</strong> {{ $feedback->type }}</p>
            <p><strong>Message:</strong> {{ $feedback->message }}</p>
            <p><strong>Status:</strong> {{ $feedback->status }}</p>
            <a href="{{ route('graduate.feedback') }}" class="btn btn-primary">Back to Feedback</a>
        </div>
    </div>
@endsection