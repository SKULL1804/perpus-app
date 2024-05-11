@extends('backend.super-admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header d-flex align-items-center">
            <div class="row">
                <h6 class="mb-0">Data Pengunjung</h6>
                <div class="col-12">
                    <a href="{{ route('data-pengunjung.excel') }}"><span class="badge bg-gradient-success">Excel</span></a>
                    {{-- <a href="{{ route('data-pengunjung.pdf') }}"><span class="badge bg-gradient-danger">PDF</span></a> --}}
                </div>
            </div>
            <div class="ms-md-auto pe-md-3 d-flex align-items-center ms-4">
                <a href="{{ route('data-pengunjung.index') }}" class="btn btn-success m-0 mx-2" role="button"><i class="fa-solid fa-rotate-right"></i></a>
                <form method="GET">
                    <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" placeholder="Seacrh ..." name="search" value="{{ $search }}" />
                    </div>
                </form>
            </div>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kelas</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Daftar</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($dataPengunjung as $dP )
                    <tr>
                      <td>
                        <div class="d-flex flex-column justify-content-center px-3">
                          <h6 class="mb-0 text-sm">{{ $dP->name }}</h6>
                          <p class="text-xs text-secondary mb-0">{{ $dP->email }}</p>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">{{ $dP->kelas->name }}</p>
                        <p class="text-xs text-secondary mb-0">{{ $dP->jurusan->name }}</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        @if (Cache::has('is-online'.$dP->id))
                            <span class="badge badge-sm bg-gradient-success">Active</span>
                        @else
                            <span class="badge badge-sm bg-gradient-danger">Non-Active</span>
                        @endif
                        <p class="text-xs text-secondary mb-0">{{ Carbon\Carbon::parse($dP->terakhir_terlihat)->diffForHumans() }}</p>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ Carbon\Carbon::parse($dP->created_at)->format('d/m/Y') }}</span>
                      </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
            </div>
            <div class="px-4 pt-2">
                {!! $dataPengunjung->appends(Request::except('page'))->render('vendor.pagination.bootstrap-5') !!}
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- <div class="row mt-4">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header pb-0 p-3">
            <h6 class="mb-0">Pengunjung Aktif</h6>
          </div>
          <div class="table-responsive px-3">
            <table class="table align-items-center">
              <tbody>
                <tr>
                  <td>
                    <div class="text-center">
                      <p class="text-xs font-weight-bold mb-0">Nama :</p>
                      <h6 class="text-sm mb-0">Azzahra</h6>
                    </div>
                  </td>
                  <td>
                    <div class="text-center">
                      <p class="text-xs font-weight-bold mb-0">Kelas:</p>
                      <h6 class="text-sm mb-0">XII RPL</h6>
                    </div>
                  </td>
                  <td class="align-middle text-sm">
                    <div class="col text-center">
                      <p class="text-xs font-weight-bold mb-0">Jurusan:</p>
                      <h6 class="text-sm mb-0">Rekayasa Perangkat Lunak</h6>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div> --}}
  </div>
@endsection
