@extends('backend.super-admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
            <div class="card-header d-flex flex-row align-items-center gap-2">
                <button class="btn btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#tambah">
                    <i class="fa-solid fa-plus me-2"></i>Tambah
                </button>
                <div class="dropdown mt-3">
                    <button class="btn bg-gradient-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Kelas
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @foreach ($kelas as $k)
                            <li>
                                <a class="dropdown-item" href="{{ route('anggota-pengunjung.index', ['kelas' => $k->name]) }}">{{ $k->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <a href="{{ route('anggota-pengunjung.pdf') }}" class="badge bg-gradient-danger badge-sm">PDF</a>
                @include('backend.super-admin.anggota-pengunjung.modal-create')
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <a href="{{ route('anggota-pengunjung.index') }}" class="btn btn-success m-0 mx-2" role="button"><i class="fas fa-undo"></i></a>
                    <form method="GET">
                        <div class="input-group">
                            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Search ..." name="search" value="{{ $search }}" />
                        </div>
                    </form>
                </div>
            </div>
            {{-- <div class="card-header d-flex flex-wrap align-items-center gap-2">
                <div class="d-flex flex-column">
                    <button class="btn btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#tambah">
                        <i class="fa-solid fa-plus me-2"></i>Tambah
                    </button>

                    <!-- Dropdown ditempatkan di bawah tombol "Tambah" -->
                    <div class="dropdown mt-3">
                        <button class="btn bg-gradient-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            Kelas
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach ($kelas as $k)
                                <li>
                                    <a class="dropdown-item" href="{{ route('anggota-pengunjung.index', ['kelas' => $k->name]) }}">{{ $k->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Elemen-elemen lain sesuai kebutuhan -->

                @include('backend.super-admin.anggota-pengunjung.modal-create')

                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <a href="{{ route('anggota-pengunjung.index') }}" class="btn btn-success m-0 mx-2" role="button"><i class="fas fa-undo"></i></a>
                    <form method="GET">
                        <div class="input-group">
                            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Search ..." name="search" value="{{ $search }}" false/>
                        </div>
                    </form>
                </div>
            </div> --}}

            {{-- <div class="card-header d-flex flex-wrap align-items-center gap-2">

                <!-- Grup tombol "Tambah" dan dropdown "Kelas" -->
                <div class="d-flex flex-column">
                    <button class="btn btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#tambah">
                        <i class="fa-solid fa-plus me-2"></i>Tambah
                    </button>

                    <!-- Dropdown ditempatkan di bawah tombol "Tambah" -->
                    <div class="dropdown mt-3">
                        <button class="btn bg-gradient-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            Kelas
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach ($kelas as $k)
                                <li>
                                    <a class="dropdown-item" href="{{ route('anggota-pengunjung.index', ['kelas' => $k->name]) }}">{{ $k->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Tombol "Undo" dan form pencarian -->
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <a href="{{ route('anggota-pengunjung.index') }}" class="btn btn-success m-0 mx-2" role="button"><i class="fas fa-undo"></i></a>
                    <form method="GET">
                        <div class="input-group">
                            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Search ..." name="search" value="{{ $search }}" false/>
                        </div>
                    </form>
                </div>
            </div> --}}


            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                  <table class="table table-flush align-items-center mb-0">
                    <thead>
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                        <th class="text-secondary opacity-7"></th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                            $ids = 1 + (($anggotaPengunjung->currentPage() - 1) * $anggotaPengunjung->perPage());
                        @endphp
                        @foreach ($anggotaPengunjung as $aP ) 
                        <tr>
                          <td>
                            <div class="d-flex flex-row align-items-center px-3">
                                <p class="text-secondary text-xs font-weight-bold mb-0">{{ $ids++ }}</p>
                                <div class="ms-2">
                                    <h6 class="mb-0 text-sm">{{ $aP->name }}</h6>
                                    <p class="text-xs font-weight-bold mb-0">{{ $aP->jurusan->name }}</p>
                                    <p class="text-xs text-secondary mb-0">{{ $aP->kelas->name }}</p>
                                </div>
                            </div>
                          </td>
                          <td class="d-flex gap-2">
                            <button type="button" class="btn btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#view{{ $aP->id }}">View</button>
                            @include('backend.super-admin.anggota-pengunjung.modal-view')
                          </td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
                <div class="px-4 pt-2">
                    {!! $anggotaPengunjung->appends(Request::except('page'))->render('vendor.pagination.bootstrap-5') !!}
                </div>
            </div>
        </div>
      </div>
    </div>
</div>
@endsection
