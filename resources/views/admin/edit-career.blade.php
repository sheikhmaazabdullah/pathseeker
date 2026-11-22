@extends('layouts.dashboard')

@section('title', 'Edit Career - PathSeeker')

@section('content')
<div class="card">
    <h5 class="card-header">Edit Career</h5>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('admin.update-career', $career->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $career->title) }}" required>
            </div>
            <div class="mb-3">
                <label for="domain" class="form-label">Domain</label>
                <input type="text" name="domain" id="domain" class="form-control" value="{{ old('domain', $career->domain) }}" required>
            </div>
            <div class="mb-3">
                <label for="salary" class="form-label">Salary</label>
                <input type="number" name="salary" id="salary" class="form-control" value="{{ old('salary', $career->salary) }}" step="1000">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control">{{ old('description', $career->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="requirements" class="form-label">Requirements (JSON)</label>
                <textarea name="requirements" id="requirements" class="form-control">{{ old('requirements', json_encode($career->requirements ?? [])) }}</textarea>
            </div>
            <div class="mb-3">
                <label for="demand_level" class="form-label">Demand Level</label>
                <select name="demand_level" id="demand_level" class="form-control" required>
                    <option value="" disabled>Select Level</option>
                    <option value="high" {{ old('demand_level', $career->demand_level) == 'high' ? 'selected' : '' }}>High</option>
                    <option value="medium" {{ old('demand_level', $career->demand_level) == 'medium' ? 'selected' : '' }}>Medium</option>
                    <option value="low" {{ old('demand_level', $career->demand_level) == 'low' ? 'selected' : '' }}>Low</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Career</button>
            <a href="{{ route('admin.careers') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection