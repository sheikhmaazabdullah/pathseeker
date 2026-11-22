@extends('layouts.app')

@section('title', 'Edit Profile - PathSeeker')

@section('content')
<div class="row">
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title mb-4">Edit Profile - {{ $user->name }}</h2>
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Edit Form -->
                <form action="{{ route('professional.updateProfile') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="education">Education</label>
                                <textarea name="education" id="education" class="form-control">{{ old('education', $user->education) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="skills">Skills (comma-separated, e.g., leadership,data analysis)</label>
                                <input type="text" name="skills" id="skills" class="form-control" value="{{ old('skills', implode(',', json_decode($user->skills ?? '[]') ?? [])) }}" placeholder="leadership,data analysis">
                            </div>
                            <div class="form-group">
                                <label for="interests">Interests (comma-separated, e.g., business consulting)</label>
                                <input type="text" name="interests" id="interests" class="form-control" value="{{ old('interests', implode(',', json_decode($user->interests ?? '[]') ?? [])) }}" placeholder="business consulting">
                            </div>
                            <div class="form-group">
                                <label for="work_experience">Work Experience</label>
                                <textarea name="work_experience" id="work_experience" class="form-control">{{ old('work_experience', $user->work_experience) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="resume">Upload Resume (PDF, DOC, DOCX, max 2MB)</label>
                                <input type="file" name="resume" id="resume" class="form-control-file">
                                @if($user->resume_path)
                                    <p>Current Resume: <a href="{{ asset('storage/' . $user->resume_path) }}" target="_blank">View</a></p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 mt-5">
                            <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                            <a href="{{ route('professional.profile') }}" class="btn btn-secondary btn-sm ml-2">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection