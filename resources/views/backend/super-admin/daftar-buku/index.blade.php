@extends('backend.super-admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex flex-wrap align-items-center gap-2">
                <button class="btn btn-primary mb-0 d-flex" data-bs-toggle="modal" data-bs-target="#tambah">
                    <i class="fa-solid fa-plus me-2 mt-1"></i>Tambah
                </button>
                @include('backend.super-admin.daftar-buku.modal-create')
                <a href="{{ route('daftar-buku.excel') }}" class="badge bg-gradient-success badge-sm">Excel</a>
                <a href="{{ route('daftar-buku.pdf') }}" class="badge bg-gradient-danger badge-sm">PDF</a>
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
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Judul</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 d-none d-md-table-cell">Foto Buku</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $ids = 1 + (($daftarBuku->currentPage() - 1) * $daftarBuku->perPage());
                            @endphp
                            @foreach ($daftarBuku as $dB)
                            <tr>
                                <td>
                                    <p class="text-secondary text-xs font-weight-bold mb-0 ps-3">{{ $ids++ }}</p>
                                </td>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <p class="mb-0 text-xs text-bolder text-uppercase">{{ $dB->judul }}</p>
                                        <p class="mb-0 text-xs text-secondary">{{ $dB['kategoriBuku']['name'] }}</p>
                                        <p class="mb-0 text-xs text-secondary">{{ $dB->pengarang }}</p>
                                        <p class="mb-0 text-xs text-secondary">{{ date('d-m-Y', strtotime($dB->tanggal_terbit)) }}</p>
                                    </div>
                                </td>
                                <td class="d-none d-md-table-cell">
                                    <img src="/Backend/assets/img/daftar-buku/{{ $dB->image_buku }}" class="img-fluid max-height-200 w-20" style="object-fit: contain;" alt="">
                                </td>
                                <td>
                                    <div class="d-flex flex-column flex-md-row gap-2">
                                        <button type="button" class="btn btn-success mb-0" data-bs-toggle="modal" data-bs-target="#edit{{ $dB->id }}">Edit</button>
                                        @include('backend.super-admin.daftar-buku.modal-edit')
                                        <button type="button" class="btn btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#view{{ $dB->id }}">View</button>
                                        @include('backend.super-admin.daftar-buku.modal-view')
                                        <form action="{{ route('daftar-buku.destroy', $dB->id) }}" method="POST" id="delete-form-{{ $dB->id }}">
                                            @csrf
                                            @method('delete')
                                            <button type="button" class="btn btn-warning mb-0 delete-button" data-id="{{ $dB->id }}"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-4 pt-2">
                    {!! $daftarBuku->appends(Request::except('page'))->render('vendor.pagination.bootstrap-5') !!}
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection


