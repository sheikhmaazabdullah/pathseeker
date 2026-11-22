@extends('layouts.dashboard')

@section('title', 'Manage Careers - PathSeeker')

@section('content')
<div class="card">
    <h5 class="card-header">Manage Careers</h5>
    <div class="card-body">
        <a href="{{ route('admin.add-career') }}" class="btn btn-primary mb-4">Create New Career</a>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Domain</th>
                        <th>Salary</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($careers as $career)
                        <tr>
                            <td>{{ $career->title }}</td>
                            <td>{{ $career->domain }}</td>
                            <td>{{ $career->salary ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('admin.view-career', $career->id) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('admin.edit-career', $career->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.delete-career', $career->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this career?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No careers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection