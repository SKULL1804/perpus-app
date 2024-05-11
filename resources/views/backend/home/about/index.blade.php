@extends('backend.super-admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="container-fluid p-4">
                        <form class="row" action="{{ route('about.update', $about->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-6">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-lg-0">
                                            <label for="judul" class="col-form-label">Judul:</label>
                                            <textarea class="form-control" rows="3" id="judul" name="judul">{{ $about->judul }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-lg-0">
                                            <label for="sub_judul" class="col-form-label">Sub Judul:</label>
                                            <input type="text" class="form-control" id="sub_judul" name="sub_judul" value="{{ $about->sub_judul }}" disabled/>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-0">
                                    <label for="deskripsi" class="col-form-label">Deskripsi:</label>
                                    <textarea class="form-control" rows="3" id="deskripsi" name="deskripsi">{{ $about->deskripsi }}</textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-lg-0">
                                    <label for="image_about" class="col-form-label">Upload Img Buku</label>
                                    <input type="file" class="form-control" id="image" name="image_about" accept="image/*"  />
                                    <img src="Backend/assets/img/about/{{ $about->image_about }}" class="img-fluid max-height-150 w-auto  mt-3" alt="" id="showimage">
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

