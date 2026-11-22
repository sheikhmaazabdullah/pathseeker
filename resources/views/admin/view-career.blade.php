@extends('layouts.dashboard')

@section('title', 'View Career - PathSeeker')

@section('content')
<div class="card">
    <h5 class="card-header">Career Details</h5>
    <div class="card-body">
        <p><strong>Title:</strong> {{ $career->title }}</p>
        <p><strong>Domain:</strong> {{ $career->domain }}</p>
        <p><strong>Salary:</strong> {{ $career->salary ? '$' . number_format($career->salary, 0) : 'N/A' }}</p>
        <p><strong>Description:</strong> {{ $career->description ?? 'N/A' }}</p>
        <p><strong>Requirements:</strong> 
            @if ($career->requirements)
                <pre>{{ $career->requirements_string }}</pre>  <!-- Use accessor -->
            @else
                N/A
            @endif
        </p>
        <p><strong>Demand Level:</strong> {{ ucfirst($career->demand_level ?? 'N/A') }}</p>
        <a href="{{ route('admin.edit-career', $career->id) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('admin.careers') }}" class="btn btn-secondary">Back</a>

        @if (!empty($recommendations))
            <h5 class="mt-4">Recommended Careers Based on Your Quiz Performance</h5>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Domain</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recommendations as $recCareer)
                            <tr>
                                <td>{{ $recCareer->title }}</td>
                                <td>{{ $recCareer->domain }}</td>
                                <td><a href="{{ route('admin.view-career', $recCareer->id) }}" class="btn btn-sm btn-info">View</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection