@extends('layouts.app')

@section('title', 'Interactive Multimedia Center - PathSeeker')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg bg-gradient-info text-white rounded-3 p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="display-5 fw-bold">Interactive Multimedia Center</h1>
                        <p class="lead">Stream videos, podcasts, and more for career insights.</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <i class="fas fa-video fa-4x opacity-75"></i>
                    </div>
                </div>
                <!-- Back to Dashboard Button -->
                <div class="text-end mt-3">
                    <a href="{{ route('graduate.dashboard') }}" class="btn btn-light btn-sm shadow">
                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Filter -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <form method="get" action="{{ route('graduate.multimedia') }}">
                        <div class="input-group mb-3">
                            <input type="text" name="search" id="searchInput" value="{{ request('search') }}" class="form-control form-control-lg border-0 shadow-sm" placeholder="Search by title or tags..." aria-label="Search Multimedia">
                            <button class="btn btn-info" type="submit">
                                <i class="fas fa-search"></i> Search
                            </button>
                            <button class="btn btn-secondary" type="button" id="clearSearch">
                                <i class="fas fa-times"></i> Clear
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <select name="type" class="form-control">
                                    <option value="">All Types</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Multimedia Listings -->
    <div class="row g-4" id="multimediaList">
        @forelse($multimedia as $item)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm hover-card">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $item->title }}</h5>
                        <p class="card-text small text-muted">Type: {{ ucfirst($item->type) }} | Category: {{ $item->category }}</p>
                        @if($item->type == 'video')
                            <video controls class="w-100">
                                <source src="{{ asset($item->file_path) }}" type="video/mp4">
                            </video>
                            <button class="btn btn-sm btn-outline-info mt-2 transcript-toggle">Toggle Transcript</button>
                            <div class="transcript d-none">Transcript not available.</div>
                        @elseif($item->type == 'audio')
                            <audio controls class="w-100">
                                <source src="{{ asset($item->file_path) }}" type="audio/mpeg">
                            </audio>
                        @elseif($item->type == 'image')
                            <img src="{{ asset($item->file_path) }}" alt="{{ $item->title }}" class="img-fluid">
                        @else
                            <a href="{{ asset($item->file_path) }}" target="_blank" class="btn btn-outline-primary btn-sm">View</a>
                        @endif
                        <div class="mt-2">
                            <span>Avg Rating: {{ number_format($item->avg_rating ?? 0, 1) }}</span>
                            <button class="btn btn-sm btn-success rate-btn" data-id="{{ $item->id }}" data-rating="up"><i class="fas fa-thumbs-up"></i></button>
                            <button class="btn btn-sm btn-danger rate-btn" data-id="{{ $item->id }}" data-rating="down"><i class="fas fa-thumbs-down"></i></button>
                        </div>
                        <button class="btn btn-outline-secondary btn-sm mt-2 bookmark-btn" data-id="{{ $item->id }}" data-type="multimedia">
                            <i class="far fa-bookmark"></i> Bookmark
                        </button>
                        <div class="related-suggestions mt-3 small">
                            <strong>Related:</strong> <span>Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                    <h5>No Multimedia Available</h5>
                </div>
            </div>
        @endforelse
    </div>
</div>

<style>
.bg-gradient-info { background: linear-gradient(135deg, #4fc3f7 0%, #15c 100%); }
.hover-card:hover { transform: translateY(-5px); transition: all 0.3s ease; box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Clear Search
    $('#clearSearch').on('click', function() {
        window.location = '{{ route("graduate.multimedia") }}';
    });

    // Transcript Toggle
    $('.transcript-toggle').click(function() {
        $(this).next('.transcript').toggleClass('d-none');
    });

    // Rating
    $('.rate-btn').click(function() {
        var btn = $(this);
        var id = btn.data('id');
        var rating = btn.data('rating');
        $.post('{{ route("graduate.rate-multimedia", ["id" => ":id"]) }}'.replace(':id', id), {rating: rating}, function(data) {
            if (data.success) {
                btn.closest('.mt-2').find('span').text('Avg Rating: ' + data.new_rating.toFixed(1));
            }
        }).fail(function() {
            alert('Error rating item');
        });
    });

    // Bookmark
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.bookmark-btn').click(function(e) {
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        var type = btn.data('type');
        $.post('{{ route("graduate.bookmarks.save") }}', {content_id: id, content_type: type}, function(data) {
            if (data.success) {
                btn.html('<i class="fas fa-bookmark"></i> Bookmarked');
                btn.prop('disabled', true);
            } else {
                alert(data.message || 'Error bookmarking');
            }
        }).fail(function() {
            alert('Error bookmarking');
        });
    });

    // Related Suggestions
    $('.related-suggestions span').each(function() {
        var card = $(this).closest('.card-body');
        var id = card.find('.bookmark-btn').data('id');
        $.get('{{ route("graduate.related", ["type" => "multimedia", "id" => ":id"]) }}'.replace(':id', id), function(related) {
            var html = related.map(function(r) { return r.title; }).join(', ') || 'None';
            card.find('.related-suggestions span').text(html);
        }).fail(function() {
            card.find('.related-suggestions span').text('None');
        });
    });
});
</script>
@endsection