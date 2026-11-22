@extends('layouts.app')

@section('title', 'Career Bank - PathSeeker')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg bg-gradient-info text-white rounded-3 p-4">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h1 class="display-5 fw-bold">Career Bank</h1>
                        <p class="lead">Explore high-demand career opportunities tailored for you.</p>
                    </div>
                    <div class="col-md-4 text-end">
                        <i class="fas fa-briefcase fa-4x opacity-75"></i>
                    </div>
                </div>
                <!-- Back to Dashboard Button -->
                <div class="text-end mt-3">
                    @if (Auth::user()->role === 'professional')
                        <a href="{{ route('professional.dashboard') }}" class="btn btn-light btn-sm shadow">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                    @else
                        <a href="{{ route('home') }}" class="btn btn-light btn-sm shadow">
                            <i class="fas fa-arrow-left"></i> Back to Home
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Search Filter -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow">
                <div class="card-body">
                    <form method="get" action="{{ route('career.index') }}" id="filterForm">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="text" name="search" id="searchInput" value="{{ request('search', auth()->user()->preferences['search'] ?? '') }}" class="form-control form-control-lg border-0 shadow-sm" placeholder="Search by job title, skills, or demand level..." aria-label="Search Careers">
                            <button class="btn btn-info" type="submit">
                                <i class="fas fa-search"></i> Search
                            </button>
                            <button class="btn btn-secondary" type="button" id="clearSearch">
                                <i class="fas fa-times"></i> Clear
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <select name="domain" class="form-control">
                                    <option value="">All Domains</option>
                                    @foreach($domains as $domain)
                                        <option value="{{ $domain }}" {{ request('domain', auth()->user()->preferences['domain'] ?? '') == $domain ? 'selected' : '' }}>{{ $domain }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="salary_min" value="{{ request('salary_min', auth()->user()->preferences['salary_min'] ?? '') }}" class="form-control" placeholder="Min Salary">
                            </div>
                            <div class="col-md-3">
                                <select name="demand_level" class="form-control">
                                    <option value="">All Demand Levels</option>
                                    @foreach($demandLevels as $level)
                                        <option value="{{ $level }}" {{ request('demand_level', auth()->user()->preferences['demand_level'] ?? '') == $level ? 'selected' : '' }}>{{ ucfirst($level) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                                <button type="button" id="saveFilters" class="btn btn-success ms-2">Save Filters</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Job Listings -->
    <div class="row g-4 mb-4" id="jobList">
        @forelse($careers as $career)
            <div class="col-lg-4 col-md-6">
                <div class="card h-100 border-0 shadow-sm hover-card">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $career->title }}</h5>
                        <p class="card-text small text-muted">{{ Str::limit($career->description, 120) }}</p>
                        <ul class="list-unstyled small">
                            <li><i class="fas fa-dollar-sign text-success"></i> Salary: ${{ number_format($career->salary ?? 0) }}</li>
                            <li><i class="fas fa-chart-bar text-info"></i> Demand: {{ ucfirst($career->demand_level ?? 'Moderate') }}</li>
                            @php
                                $reqJson = $career->requirements ?? '{}';
                                $reqArray = is_array($reqJson) || is_object($reqJson) ? (array) $reqJson : json_decode($reqJson, true) ?? [];
                                $skills = $reqArray['skills'] ?? [];
                                if (is_string($skills)) {
                                    $skills = json_decode($skills, true) ?? [];
                                } elseif (!is_array($skills)) {
                                    $skills = [];
                                }
                            @endphp
                            <li><i class="fas fa-tools text-warning"></i> Skills: {{ implode(', ', $skills) }}</li>
                        </ul>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('career.show', $career->id) }}" class="btn btn-outline-primary btn-sm mt-2">View Details</a>
                            <button class="btn btn-outline-primary btn-sm mt-2 bookmark-btn" data-id="{{ $career->id }}" data-type="App\Models\Career">
                                <i class="far fa-bookmark"></i> Bookmark
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                    <h5>No Careers Available</h5>
                    <p>Check back later or try adjusting your filters!</p>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
<!-- Custom Styles -->
<style>
.bg-gradient-info {
    background: linear-gradient(135deg, #4fc3f7 0%, #15c 100%);
}
.hover-card:hover {
    transform: translateY(-5px);
    transition: all 0.3s ease;
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}
#searchInput:focus {
    box-shadow: 0 0 0 0.2rem rgba(23, 162, 184, 0.25);
}
.bookmark-btn {
    display: inline-block !important;
    visibility: visible !important;
    opacity: 1 !important;
}
.row.mb-4 {
    margin-bottom: 2rem !important;
}
</style>
@push('scripts')
<!-- Scripts -->
<script>
$(document).ready(function() {

    // Autocomplete
    $('#searchInput').autocomplete({
        source: function(request, response) {
            $.getJSON('{{ route("career.search-suggestions") }}', { term: request.term }, function(data) {
                response(data);
            });
        },
        minLength: 2
    });

    // Clear Search
    $('#clearSearch').on('click', function() {
        window.location = '{{ route("career.index") }}';
    });

    // Save Filters
    $('#saveFilters').click(function(e) {
        e.preventDefault();
        var formData = $('#filterForm').serialize();
        $.post('{{ route("career.save-preferences") }}', formData, function(data) {
            if (data.success) {
                alert('Preferences saved successfully!');
            }
        }).fail(function(jqXHR) {
            console.error('Error saving preferences:', jqXHR.responseText);
        });
    });

    // Bookmark Functionality
    $(document).on('click', '.bookmark-btn', function(e) {
        e.preventDefault();
        var btn = $(this);
        var id = btn.data('id');
        var type = btn.data('type');

        $.ajax({
            url: '{{ route("career.bookmarks.save") }}',
            type: 'POST',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                bookmarkable_id: id,
                bookmarkable_type: type
            },
            success: function(data) {
                if (data.success) {
                    btn.html('<i class="fas fa-bookmark"></i> Bookmarked');
                    btn.prop('disabled', true);
                } else {
                    alert(data.message || 'Already bookmarked!');
                }
            },
            error: function(jqXHR) {
                console.error('Bookmark error:', jqXHR.responseText);
                alert('Error! Check console for details.');
            }
        });
    });

});
</script>
@endpush