@extends('layouts.dashboard')

@section('title', 'View Feedback - PathSeeker')

@section('content')
<div class="card">
    <h5 class="card-header">Feedback Details</h5>
    <div class="card-body">
        <p><strong>Type:</strong> {{ ucfirst($feedback->type) }}</p>
        <p><strong>Message:</strong> {{ $feedback->message }}</p>
        <p><strong>User:</strong> {{ $feedback->user->name ?? 'N/A' }}</p>
        <p><strong>Sentiment:</strong> {{ ucfirst($feedback->sentiment) ?? 'N/A' }}</p>
        <p><strong>Submitted At:</strong> {{ $feedback->created_at->format('Y-m-d H:i:s') }}</p>
        <a href="{{ route('admin.edit-feedback', $feedback->id) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('admin.feedback') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection