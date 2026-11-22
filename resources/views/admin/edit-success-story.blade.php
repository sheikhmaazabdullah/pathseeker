@extends('layouts.dashboard')
@section('title', 'Edit Success Story - PathSeeker')
@section('content')
<div class="admin-edit">
    <h2>Edit Success Story</h2>
    <form method="POST" action="{{ route('admin.update-success-story', $story->id) }}">
        @csrf @method('PUT')
        <!-- Fields similar to add, with value="{{ old('', $story->field) }}" -->
        <div class="form-group">
            <label>Status</label>
            <select name="status" class="form-control">
                <option value="pending" {{ $story->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ $story->status == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ $story->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection