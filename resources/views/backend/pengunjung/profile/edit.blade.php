@extends('backend.pengunjung.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-lg-6 mt-lg-0 mt-4">
        <div class="card card-body" id="profile">
          <div class="row flex-column align-items-center">
            <div class="col-sm-auto col-4">
              <div class="avatar avatar-xl position-relative">
                <img id="showimage" src="{{ (!empty($user->avatar))? url('/Backend/assets/img/avatar/'.$user->avatar):url('/Backend/assets/img/no-image.png') }}" alt="" class="w-100 border-radius-lg shadow-sm" />
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
            <form method="POST" action="{{ route('pengunjung-profile.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <label class="form-label">Nama</label>
                    <div class="input-group">
                      <input id="name" name="name" class="form-control" type="text" required="required" value="{{ $user->name }}" />
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <label class="form-label">Username</label>
                    <div class="input-group">
                      <input id="username" name="username" class="form-control" type="text" required="required" value="{{ $user->username }}"/>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 col-sm-12">
                    <label class="form-label mt-md-4 mt-0">Email</label>
                    <div class="input-group">
                      <input id="email" name="email" class="form-control" type="email" value="{{ $user->email }}" />
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <label class="form-label mt-md-4 mt-0">Upload Picture Profile</label>
                    <div class="input-group">
                      <input id="image" name="avatar" class="form-control" type="file" />
                    </div>
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

@push('script')
<!-- Show Image -->
<script src="{{ asset('js/show-image.js') }}"></script>
@endpush
