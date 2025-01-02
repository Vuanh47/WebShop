@extends('pages.mainprofile')

@section('content_profile')
<div class="p-3 mt-4 col-md-9">
  <div class="password-change-card">
    <h3>Change Password</h3>

    <!-- Password Change Form -->
    <form action="{{ route('password.update') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label for="current_password" class="form-label">Current Password</label>
        <input type="password" class="form-control" id="current_password" name="current_password" required>
        @error('current_password')
        <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="new_password" class="form-label">New Password</label>
        <input type="password" class="form-control" id="new_password" name="new_password" required>
        @error('new_password')
        <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>

      <div class="mb-3">
        <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
        <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
        @error('new_password_confirmation')
        <div class="text-danger">{{ $message }}</div>
        @enderror
      </div>
      @include('admin.alert')
      <button type="submit" class="btn btn-primary">Change Password</button>
    </form>
  </div>
</div>
@endsection