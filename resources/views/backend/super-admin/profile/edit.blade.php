@extends('backend.super-admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-lg-6 mt-lg-0 mt-4">
        <div class="card card-body" id="profile">
          <div class="row flex-column align-items-center">
            <div class="col-sm-auto col-4">
                <div class="avatar avatar-xl position-relative">
                    <img id="showimage" src="{{ (!empty($user->avatar)) ? url('/Backend/assets/img/avatar/'.$user->avatar) : url('/Backend/assets/img/no-image.png') }}" alt="" class="w-100 border-radius-lg shadow-sm" />
                </div>
            </div>
            <div class="col-sm-auto col-8 my-auto">
              <div class="h-100 text-center">
                <h5 class="mb-1 font-weight-bolder">{{ $user->name }}</h5>
                <p class="mb-0 font-weight-bold text-sm">{{ $user->role }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 mt-lg-0 mt-4">
        <div class="card" id="basic-info">
          <div class="card-header">
            <h5>Profile Edit</h5>
          </div>
          <div class="card-body pt-0">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <label for="name" class="form-label">Nama</label>
                        <div class="input-group">
                            <input id="name" name="name" class="form-control" type="text" required="required" value="{{ $user->name }}"/>
                        </div>
                        @error('name')
                            <span class="text-danger text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group">
                            <input id="username" name="username" class="form-control" type="text" required="required" value="{{ $user->username }}" />
                        </div>
                        @error('username')
                            <span class="text-danger text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <label for="email"  class="form-label mt-md-4 mt-0">Email</label>
                        <div class="input-group">
                            <input id="email" name="email" class="form-control" type="email" required="required" value="{{ $user->email }}" />
                        </div>
                        @error('email')
                            <span class="text-danger text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="avatar" class="form-label mt-md-4 mt-0">Upload Picture Profile</label>
                        <div class="input-group">
                            <input id="image" name="avatar" class="form-control" type="file" accept="image/*" />
                        </div>
                        @error('avatar')
                            <span class="text-danger text-xs">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="d-flex flex-shrink-0 flex-wrap align-items-center justify-content-end pt-2">
                    <button type="submit" class="btn btn-success btn-sm mb-0">Update</button>
                </div>
            </form>

          </div>
        </div>
      </div>
    </div>
</div>
@endsection

