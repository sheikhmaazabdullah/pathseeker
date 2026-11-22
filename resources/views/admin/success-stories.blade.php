@extends('layouts.dashboard')

@section('title', 'Manage Success Stories - PathSeeker')

@section('content')
<div class="card">
    <h5 class="card-header">Manage Success Stories</h5>
    <div class="card-body">
        <a href="{{ route('admin.add-success-story') }}" class="btn btn-primary mb-4">Add New Story</a>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Domain</th>
                        <th>User</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($stories as $story)
                        <tr>
                            <td>{{ $story->title }}</td>
                            <td>{{ $story->domain }}</td>
                            <td>{{ $story->user->name }}</td>
                            <td>{{ ucfirst($story->status) }}</td>
                            <td>
                                <a href="{{ route('admin.view-success-story', $story->id) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('admin.edit-success-story', $story->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.delete-success-story', $story->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center">No stories.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection