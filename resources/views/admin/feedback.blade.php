@extends('layouts.dashboard')

@section('title', 'Manage Feedback - PathSeeker')

@section('content')
<div class="card">
    <h5 class="card-header">Manage Feedback & Analytics</h5>
    <div class="card-body">
        <h6>Analytics</h6>
        <ul>
            @if(is_array($analytics['by_type']) && count($analytics['by_type']) > 0)
                @foreach($analytics['by_type'] as $type => $count)
                    <li>{{ ucfirst($type) }}: {{ $count }}</li>
                @endforeach
            @else
                <li>No feedback types yet.</li>
            @endif
        </ul>
        <ul>
            @if(is_array($analytics['sentiment_summary']) && count($analytics['sentiment_summary']) > 0)
                @foreach($analytics['sentiment_summary'] as $sent => $count)
                    <li>{{ ucfirst($sent) }}: {{ $count }}</li>
                @endforeach
            @else
                <li>No sentiment data yet.</li>
            @endif
        </ul>
        {{-- <a href="{{ route('admin.add-feedback') }}" class="btn btn-primary mb-4">Add Feedback</a> --}}
        <table class="table table-hover">
            <thead><tr><th>Type</th><th>Message</th><th>User</th><th>Sentiment</th><th>Actions</th></tr></thead>
            <tbody>
                @forelse ($feedback as $item)
                    <tr>
                        <td>{{ ucfirst($item->type) }}</td>
                        <td>{{ Str::limit($item->message, 50) }}</td>
                        <td>{{ $item->user->name ?? 'N/A' }}</td>
                        <td>{{ ucfirst($item->sentiment ?? 'N/A') }}</td>
                        <td>
                            <a href="{{ route('admin.view-feedback', $item->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('admin.edit-feedback', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.delete-feedback', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">No feedback found. Add some to see analytics.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection