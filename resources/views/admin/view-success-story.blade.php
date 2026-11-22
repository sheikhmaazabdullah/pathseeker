@extends('layouts.dashboard')
@section('title', 'View Success Story - PathSeeker')
@section('content')
<div class="admin-view">
    <h2>{{ $story->title }}</h2>
    <p><strong>Domain:</strong> {{ $story->domain }}</p>
    <p><strong>Story:</strong> {{ $story->story_text }}</p>
    <p><strong>Timeline:</strong> {{ json_encode($story->timeline) }}</p>
    <p><strong>User:</strong> {{ $story->user->name }}</p>
    <p><strong>Status:</strong> {{ ucfirst($story->status) }}</p>
    <a href="{{ route('admin.success-stories') }}" class="btn btn-secondary">Back</a>
</div>
@endsection