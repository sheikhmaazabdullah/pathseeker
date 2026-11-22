@extends('layouts.dashboard')

@section('title', 'Manage Users - PathSeeker')

@section('content')
<div class="card">
    <h5 class="card-header">Manage Users</h5>
    <div class="card-body">
        <a href="{{ route('admin.add-user') }}" class="btn btn-primary mb-4">Create New User</a>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->role ?? 'N/A' }}</td>
                            <td>
                                <a href="{{ route('admin.view-user', $user->id) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('admin.edit-user', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.delete-user', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection