@extends('layouts.dashboard')

@section('title', 'Add Career - PathSeeker')

@section('content')
<div class="admin-add-career">
    <h2>Add New Career</h2>
    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif
    <form method="POST" action="{{ route('admin.store-career') }}">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
        </div>
        <div class="form-group">
            <label for="domain">Domain</label>
            <input type="text" name="domain" id="domain" class="form-control" value="{{ old('domain') }}" required>
        </div>
        <div class="form-group">
            <label for="salary">Salary</label>
            <input type="number" step="0.01" name="salary" id="salary" class="form-control" value="{{ old('salary') }}">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label for="requirements">Requirements (JSON)</label>
            <textarea name="requirements" id="requirements" class="form-control">{{ old('requirements') }}</textarea>
        </div>
        <div class="form-group">
            <label for="demand_level">Demand Level</label>
            <select name="demand_level" id="demand_level" class="form-control" required>
                <option value="" disabled selected>Select Level</option>
                <option value="high">High</option>
                <option value="medium">Medium</option>
                <option value="low">Low</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Career</button>
    </form>
</div>
@endsection