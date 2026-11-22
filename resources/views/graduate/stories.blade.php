@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1>Success Stories</h1>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('graduate.stories') }}" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <select name="domain" class="form-control">
                        <option value="">All Domains</option>
                        @foreach ($domains as $domain)
                            <option value="{{ $domain }}" {{ request('domain') == $domain ? 'selected' : '' }}>
                                {{ $domain }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>

        <!-- Stories List -->
        @if ($stories->isEmpty())
            <p>No success stories available.</p>
        @else
            @foreach ($stories as $story)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $story->title }}</h5>
                        <p class="card-text">{{ $story->story_text }}</p>
                        @if ($story->timeline && is_array($story->timeline))
                            <p class="card-text"><strong>Timeline:</strong>
                                @foreach ($story->timeline as $key => $value)
                                    @if (is_array($value))
                                        <span>{{ $key }}: {{ implode(', ', $value) }}</span><br>
                                    @else
                                        <span>{{ $key }}: {{ $value }}</span><br>
                                    @endif
                                @endforeach
                            </p>
                        @else
                            <p class="card-text"><strong>Timeline:</strong> Not available</p>
                        @endif
                        <p class="card-text"><small class="text-muted">Domain: {{ $story->domain }}</small></p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection