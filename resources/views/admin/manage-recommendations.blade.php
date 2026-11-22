@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Manage Career Recommendations</h1>

        <!-- Add New Recommendation Form -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Add New Recommendation</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.add-recommendation') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="career_id" class="form-label">Career</label>
                        <select name="career_id" id="career_id" class="form-control" required>
                            <option value="" disabled selected>Select Career</option>
                            @foreach ($careers as $career)
                                <option value="{{ $career->id }}">{{ $career->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quiz_category" class="form-label">Quiz Category</label>
                        <select name="quiz_category" id="quiz_category" class="form-control" required>
                            <option value="" disabled selected>Select Quiz Category</option>
                            @foreach ($quizTypes as $quizType)
                                <option value="{{ $quizType }}">{{ $quizType }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="min_percentage" class="form-label">Minimum Percentage</label>
                        <input type="number" name="min_percentage" id="min_percentage" class="form-control" min="0" max="100" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Recommendation</button>
                </form>
            </div>
        </div>

        <!-- Existing Recommendations -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Existing Recommendations</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Career</th>
                                <th>Quiz Category</th>
                                <th>Min Percentage</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($careers as $career)
                                @foreach ($career->recommendations as $recommendation)
                                    <tr>
                                        <td>{{ $career->title }}</td>
                                        <td>{{ $recommendation->quiz_category }}</td>
                                        <td>{{ $recommendation->min_percentage }}%</td>
                                        <td>
                                            <a href="{{ route('admin.edit-recommendation', $recommendation->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="{{ route('admin.delete-recommendation', $recommendation->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection