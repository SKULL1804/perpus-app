@extends('backend.admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-6 mt-lg-0 mt-4">
            <div class="card card-body" id="profile">
              <div class="row justify-content-center align-items-center">
                <div class="col-sm-auto col-12 my-2">
                  <div class="h-100">
                    <h5>Password requirements</h5>
                    <p class="text-muted mb-2">Please follow this guide for a strong password:</p>
                    <ul class="text-muted ps-4 mb-0 float-start">
                      <li>
                        <span class="text-sm">One special characters</span>
                      </li>
                      <li>
                        <span class="text-sm">Min 8 characters</span>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
      <div class="col-lg-6 mt-lg-0 mt-4">
        <div class="card" id="password">
            <div class="card-header">
                <h5>Change Password</h5>
            </div>
            <div class="card-body pt-0">
                <form method="POST" action="{{ route('admin-change-password.update') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="currentPassword" class="form-label">Current password</label>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="Current password" name="currentPassword" id="currentPassword" required="required" />
                                </div>
                                @error('currentPassword')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="newPassword" class="form-label">New password</label>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="New password" name="newPassword" id="newPassword" required="required"  />
                                </div>
                                @error('newPassword')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="confirmPassword" class="form-label">Confirm new password</label>
                                <div class="form-group">
                                    <input class="form-control" type="password" placeholder="Confirm password" name="confirmPassword" id="confirmPassword" required="required" />
                                </div>
                                @error('confirmPassword')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="show" name="show">
                                    <label class="custom-control-label" for="customCheck1">Show Password</label>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm float-end mt-2 mb-0">Update password</button>
                </form>
            </div>

        </div>
      </div>
    </div>
</div>
@endsection

@push('script')
    <script src="{{ asset('js/show-password.js') }}"></script>
@endpush
