@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Edit Career Recommendation</h1>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Edit Recommendation</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.update-recommendation', $recommendation->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="career_id" class="form-label">Career</label>
                        <select name="career_id" id="career_id" class="form-control" required>
                            @foreach ($careers as $career)
                                <option value="{{ $career->id }}" {{ $recommendation->career_id == $career->id ? 'selected' : '' }}>{{ $career->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quiz_category" class="form-label">Quiz Category</label>
                        <select name="quiz_category" id="quiz_category" class="form-control" required>
                            <option value="" disabled>Select Quiz Category</option>
                            @foreach ($quizTypes as $quizType)
                                <option value="{{ $quizType }}" {{ $recommendation->quiz_category == $quizType ? 'selected' : '' }}>{{ $quizType }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="min_percentage" class="form-label">Minimum Percentage</label>
                        <input type="number" name="min_percentage" id="min_percentage" class="form-control" min="0" max="100" value="{{ $recommendation->min_percentage }}" required>
                    </div>
                    <a href="{{ route('admin.recommendations') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Update Recommendation</button>
                </form>
            </div>
        </div>
    </div>
@endsection