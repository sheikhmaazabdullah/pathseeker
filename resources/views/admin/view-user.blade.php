@extends('layouts.dashboard')
  @section('title', 'View User - PathSeeker')
  @section('content')
  <div class="admin-view-user">
      <h2>User Details</h2>
      <div class="card">
          <div class="card-body">
              <p><strong>Name:</strong> {{ $user->name }}</p>
              <p><strong>Email:</strong> {{ $user->email }}</p>
              <p><strong>Role:</strong> {{ $user->role }}</p>
              <p><strong>Education:</strong> {{ $user->education ?? 'N/A' }}</p>
              <p><strong>Skills:</strong> {{ implode(', ', json_decode($user->skills ?? '[]')) }}</p>
              <a href="{{ route('admin.users') }}" class="btn btn-secondary">Back</a>
          </div>
      </div>
  </div>
  @endsection