@extends('layouts.app')

@section('title', 'Profile - PathSeeker')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title mb-4">Profile - {{ $user->name }}</h2>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="row">
                    <div class="col-md-12">
                        <p><strong>Email:</strong> {{ $user->email }}</p>
                        <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($user->status) }}</p>
                        <p><strong>Education:</strong> {{ $user->education ?? 'N/A' }}</p>
                        <p><strong>Skills:</strong> {{ implode(', ', json_decode($user->skills ?? '[]') ?? []) }}</p>
                        <p><strong>Interests:</strong> {{ implode(', ', json_decode($user->interests ?? '[]') ?? []) }}</p>
                        <p><strong>Work Experience:</strong> {{ $user->work_experience ?? 'N/A' }}</p>
                        <p><strong>Resume:</strong> 
                            @if($user->resume_path)
                                <a href="{{ asset('storage/' . $user->resume_path) }}" target="_blank" class="btn btn-primary btn-sm">View Resume</a>
                            @else
                                N/A
                            @endif
                        </p>
                    </div>
                    <div class="col-md-12 mt-5">
                        <a href="{{ route('professional.showUpdateProfile') }}" class="btn btn-primary btn-sm">Edit Profile</a>
                        <a href="{{ route('professional.dashboard') }}" class="btn btn-secondary btn-sm ml-2">Back to Dashboard</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection