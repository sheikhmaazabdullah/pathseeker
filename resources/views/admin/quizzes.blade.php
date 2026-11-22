@extends('layouts.dashboard')
@section('title', 'Manage Quizzes - PathSeeker')
@section('content')
<div class="card">
    <h5 class="card-header">Manage Quizzes</h5>
    <div class="card-body">
        <a href="{{ route('admin.add-quiz') }}" class="btn btn-primary mb-4">Create New Quiz</a>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Focus User Type</th>
                        <th>Questions</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($quizzes as $quiz)
                        <tr>
                            <td>{{ $quiz->title }}</td>
                            <td>{{ $quiz->category }}</td>
                            <td>{{ $quiz->focus_user_type ?? 'N/A' }}</td>
                            <td>{{ $quiz->questions_count }}</td>
                            <td>
                                <a href="{{ route('admin.view-quiz', $quiz->id) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('admin.edit-quiz', $quiz->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.delete-quiz', $quiz->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this quiz?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No quizzes found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection