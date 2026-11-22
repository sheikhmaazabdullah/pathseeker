@extends('layouts.dashboard')

@section('title', 'Edit Multimedia - PathSeeker')

@section('content')
<div class="card">
    <h5 class="card-header">Edit Multimedia</h5>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.update-multimedia', $multimedia->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $multimedia->title) }}" required>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select name="type" id="type" class="form-control" required>
                    <option value="" disabled>Select Type</option>
                    <option value="video" {{ old('type', $multimedia->type) == 'video' ? 'selected' : '' }}>Video</option>
                    <option value="image" {{ old('type', $multimedia->type) == 'image' ? 'selected' : '' }}>Image</option>
                    <option value="pdf" {{ old('type', $multimedia->type) == 'pdf' ? 'selected' : '' }}>PDF</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="file" class="form-label">Update File (Optional)</label>
                <input type="file" name="file" id="file" class="form-control" accept=".pdf,.jpg,.png,.mp4">
                <small>Current File: {{ $multimedia->file_path }}</small>
            </div>
            <div class="mb-3">
                <label for="tags" class="form-label">Tags (JSON)</label>
                <textarea name="tags" id="tags" class="form-control">{{ old('tags', json_encode($multimedia->tags ?? [])) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <input type="text" name="category" id="category" class="form-control" value="{{ old('category', $multimedia->category) }}">
            </div>
            <button type="submit" class="btn btn-primary">Update Multimedia</button>
            <a href="{{ route('admin.multimedia') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection