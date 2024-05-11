@extends('backend.super-admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center gap-2">
                <button class="btn btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#tambah">
                    <i class="fa-solid fa-plus me-2"></i>Tambah
                </button>
                @include('backend.super-admin.anggota-perpustakaan.modal-create')
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <a href="{{ route('daftar-buku.index') }}" class="btn btn-success m-0 mx-2" role="button"><i class="fas fa-undo"></i></a>
                    <form method="GET">
                        <div class="input-group">
                            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Search ..." name="search" value="{{ $search }}" false/>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                  <table class="table table-flush align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama Anggota</th>
                        <th class="text-secondary opacity-7"></th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $ids = 1 + (($anggotaPerpustakaan->currentPage() - 1) * $anggotaPerpustakaan->perPage());
                        @endphp
                        @foreach ($anggotaPerpustakaan as $aP )
                        <tr>
                          <td>
                            <p class="text-secondary text-xs font-weight-bold mb-0 ps-2">{{ $ids++ }}</p>
                          </td>
                          <td>
                              <div class="d-flex flex-column justify-content-center">
                                <p class="mb-0 text-sm">{{ $aP->name }}</p>
                                <p class="text-xs font-weight-bold mb-0">{{ $aP->role }}</p>
                            </div>
                          </td>

                          <td class="d-flex gap-2">
                            <button type="button" class="btn btn-success mb-0" data-bs-toggle="modal" data-bs-target="#edit{{ $aP->id }}">Edit</button>
                            @include('backend.super-admin.anggota-perpustakaan.modal-edit')
                            <button type="button" class="btn btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#view{{ $aP->id }}">View</button>
                            @include('backend.super-admin.anggota-perpustakaan.modal-view')
                            <form action="{{ route('anggota-perpustakaan.destroy', $aP->id) }}" method="POST" id="delete-form-{{ $aP->id }}">
                                @csrf
                                @method('delete')
                                <button type="button" class="btn btn-warning mb-0 delete-button" data-id="{{ $aP->id }}"><i class="fa-solid fa-trash"></i></button>
                            </form>
                          </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="px-4 pt-2">
                    {!! $anggotaPerpustakaan->appends(Request::except('page'))->render('vendor.pagination.bootstrap-5') !!}
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection
