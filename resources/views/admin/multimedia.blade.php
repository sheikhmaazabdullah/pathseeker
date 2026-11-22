@extends('layouts.dashboard')

@section('title', 'Manage Multimedia - PathSeeker')

@section('content')
<div class="card">
    <h5 class="card-header">Manage Multimedia</h5>
    <div class="card-body">
        <a href="{{ route('admin.upload-content') }}" class="btn btn-primary mb-4">Upload New Content</a>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($multimedia as $item)
                        <tr>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->type }}</td>
                            <td>
                                <a href="{{ route('admin.view-multimedia', $item->id) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('admin.edit-multimedia', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.delete-multimedia', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this multimedia?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No multimedia found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection