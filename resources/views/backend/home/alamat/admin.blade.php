@extends('backend.admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="container-fluid p-4">
                        <form class="row" action="{{ route('admin-alamat.update', $alamat->id) }}" method="POST">
                            @csrf
                            <div class="col-6">
                                <div class="mb-lg-0">
                                    <label for="alamat" class="col-form-label">Alamat:</label>
                                    <textarea class="form-control" rows="4" id="alamat" name="alamat">{{ $alamat->alamat }}</textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-lg-0">
                                    <label for="email" class="col-form-label">Email Perpustakaan Nuris:</label>
                                    <input class="form-control" type="email" id="email" name="email" value="{{ $alamat->email }}"></>
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
</div>
@endsection

