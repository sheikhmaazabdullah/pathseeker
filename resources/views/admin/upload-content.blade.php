@extends('layouts.dashboard')
  @section('title', 'Upload Content - PathSeeker')
  @section('content')
  <div class="admin-upload-content">
      <h2>Upload New Content</h2>
      @if ($errors->any())
          <div class="alert alert-danger">{{ $errors->first() }}</div>
      @endif
      <form method="POST" action="{{ route('admin.store-content') }}" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
              <label for="title">Title</label>
              <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
          </div>
          <div class="form-group">
              <label for="type">Type</label>
              <select name="type" id="type" class="form-control" required>
                  <option value="video">Video</option>
                  <option value="image">Image</option>
                  <option value="pdf">PDF</option>
              </select>
          </div>
          <div class="form-group">
              <label for="file">File</label>
              <input type="file" name="file" id="file" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary">Upload Content</button>
      </form>
  </div>
  @endsection