@extends('layouts.dashboard')
  @section('title', 'Add User - PathSeeker')
  @section('content')
  <div class="admin-add-user">
      <h2>Add New User</h2>
      @if ($errors->any())
          <div class="alert alert-danger">{{ $errors->first() }}</div>
      @endif
      <form method="POST" action="{{ route('admin.store-user') }}">
          @csrf
          <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
          </div>
          <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
          </div>
          <div class="form-group">
              <label for="role">Role</label>
              <select name="role" id="role" class="form-control" required>
                  <option value="student">Student</option>
                  <option value="graduate">Graduate</option>
                  <option value="professional">Professional</option>
                  <option value="admin">Admin</option>
              </select>
          </div>
          <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" id="password" class="form-control" required>
          </div>
          <button type="submit" class="btn btn-primary">Add User</button>
      </form>
  </div>
  @endsection