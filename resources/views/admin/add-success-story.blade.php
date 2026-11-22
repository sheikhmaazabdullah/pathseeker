@extends('layouts.dashboard')
@section('title', 'Add Success Story - PathSeeker')
@section('content')
<div class="admin-add">
    <h2>Add New Success Story</h2>
    @if ($errors->any()) <div class="alert alert-danger">{{ $errors->first() }}</div> @endif
    <form method="POST" action="{{ route('admin.store-success-story') }}">
        @csrf
        <div class="form-group">
            <label>Title</label><input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>
        <div class="form-group">
            <label>Domain</label><input type="text" name="domain" class="form-control" value="{{ old('domain') }}" required>
        </div>
        <div class="form-group">
            <label>Story Text</label><textarea name="story_text" class="form-control" required>{{ old('story_text') }}</textarea>
        </div>
        <div class="form-group">
            <label>Timeline (JSON)</label><textarea name="timeline" class="form-control">{{ old('timeline') }}</textarea>
        </div>
        <div class="form-group">
            <label>User ID (optional)</label><input type="number" name="user_id" class="form-control" value="{{ old('user_id') }}">
        </div>
        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>
@endsection