@extends('layouts.dashboard')

@section('title', 'User Approval Requests - PathSeeker')

@section('content')
<div class="card">
    <h5 class="card-header">User Approval Requests</h5>
    <div class="card-body">
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
                    @forelse ($pendingUsers as $user)
                        <tr>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->role ?? 'N/A' }}</td>
                            <td>
                                <form action="{{ route('admin.approve.user', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to approve this user?');">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                </form>
                                <form action="{{ route('admin.reject.user', $user->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to reject this user?');">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No pending approval requests.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection