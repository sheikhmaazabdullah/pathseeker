@extends('layouts.dashboard')

@section('title', 'View Multimedia - PathSeeker')

@section('content')
<div class="card">
    <h5 class="card-header">Multimedia Details</h5>
    <div class="card-body">
        <p><strong>Title:</strong> {{ $multimedia->title }}</p>
        <p><strong>Type:</strong> {{ ucfirst($multimedia->type) }}</p>
        <p><strong>File Path:</strong> {{ $multimedia->file_path }}</p>
        <p><strong>Tags:</strong> 
            @if ($multimedia->tags)
                <pre>{{ $multimedia->tags_string }}</pre>  <!-- Use accessor -->
            @else
                N/A
            @endif
        </p>
        <p><strong>Category:</strong> {{ $multimedia->category ?? 'N/A' }}</p>
        <p><strong>Download Count:</strong> {{ $multimedia->download_count ?? 0 }}</p>
        <a href="{{ route('admin.edit-multimedia', $multimedia->id) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('admin.multimedia') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection