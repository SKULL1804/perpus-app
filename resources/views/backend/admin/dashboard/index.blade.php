@extends('backend.admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <!-- Add Buku View -->
      <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-body p-3">
            <div class="row">
              <div class="col-8">
                <div class="numbers">
                  <p class="text-sm mb-0 text-uppercase font-weight-bold">Penambahan Buku</p>
                  <h5 class="font-weight-bolder">{{ $DaftarBukuCount }}</h5>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                  <i class="ni ni-fat-add text-lg opacity-10" aria-hidden="true"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
    <!-- End Add Buku View -->
    <div class="row mt-4">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center gap-2">
              <a href="{{ route('admin-dashboard.index') }}" class="btn btn-success m-0 mx-2" role="button"><i class="fa-solid fa-rotate-right"></i></a>
            <div class="ms-md-auto pe-md-3 d-flex align-items-center ms-4">
                <form method="GET">
                    <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" placeholder="Seacrh ..." name="search"value="{{ $search }}" />
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
                                    <button type="button" class="btn btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#view{{ $dB->id }}">View</button>
                                    @include('backend.admin.dashboard.modal-view')
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
