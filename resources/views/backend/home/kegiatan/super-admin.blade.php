@extends('backend.super-admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-body px-0 pt-0 pb-2">
            <div class="container-fluid p-4">
              <form class="row" action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-6">
                    <div class="row">
                        <div class="mb-lg-0">
                          <label for="judul_kegiatan" class="col-form-label">Judul Kegiatan:</label>
                          <input type="text" class="form-control" id="judul_kegiatan" name="judul_kegiatan" value="{{ $kegiatan->judul_kegiatan }}" />
                        </div>
                        <div class="mb-lg-0">
                          <label for="deskripsi_kegiatan" class="col-form-label">Deskripsi kegiatan:</label>
                          <textarea class="form-control" id="deskripsi_kegiatan" name="deskripsi_kegiatan">{{ $kegiatan->deskripsi_kegiatan }}</textarea>
                        </div>
                        <div class="col-6">
                            <div class="mb-0">
                              <label for="tempat" class="col-form-label">Tempat:</label>
                              <input type="text" class="form-control" id="tempat" name="tempat" value="{{ $kegiatan->tempat }}" />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-0">
                              <label for="tanggal" class="col-form-label">Waktu:</label>
                              <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ $kegiatan->tanggal }}" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                  <div class="mb-lg-0">
                    <label for="image" class="col-form-label">Upload Img Buku</label>
                    <input type="file" class="form-control" id="image" name="image_kegiatan" />
                    <img id="showimage" src="Backend/assets/img/kegiatan/{{ $kegiatan->image_kegiatan }}" class="img-fluid max-height-200 w-auto  mt-3" alt="">
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
