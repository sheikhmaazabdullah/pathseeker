@extends('layouts.dashboard')
  @section('title', 'Edit User - PathSeeker')
  @section('content')
  <div class="admin-edit-user">
      <h2>Edit User</h2>
      @if ($errors->any())
          <div class="alert alert-danger">{{ $errors->first() }}</div>
      @endif
      <form method="POST" action="{{ route('admin.update-user', $user->id) }}">
          @csrf
          @method('PUT')
          <div class="form-group">
              <label for="name">Name</label>
              <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
          </div>
          <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
          </div>
          <div class="form-group">
              <label for="role">Role</label>
              <select name="role" id="role" class="form-control" required>
                  <option value="student" {{ old('role', $user->role) === 'student' ? 'selected' : '' }}>Student</option>
                  <option value="graduate" {{ old('role', $user->role) === 'graduate' ? 'selected' : '' }}>Graduate</option>
                  <option value="professional" {{ old('role', $user->role) === 'professional' ? 'selected' : '' }}>Professional</option>
                  <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
              </select>
          </div>
          <div class="form-group">
              <label for="password">Password (leave blank to keep current)</label>
              <input type="password" name="password" id="password" class="form-control">
          </div>
          <button type="submit" class="btn btn-primary">Update User</button>
      </form>
  </div>
  @endsection