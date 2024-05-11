@extends('backend.super-admin.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
              <div class="card-header d-flex align-items-center gap-2">
                <h6 class="mb-0">{{ $title }}</h6>
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <a href="{{ route('history-pengunjung.index') }}" class="btn btn-success m-0 mx-2" role="button"><i class="fas fa-undo"></i></a>
                    <form action="{{ route('history-pengunjung.index') }}" method="GET">
                        <div class="input-group">
                            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                            <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Enter name...">
                        </div>
                    </form>
                </div>
              </div>
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Buku</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tanggal Baca</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($dataPengunjung as $pengunjung)
                    <tr>
                        <td>
                            <div class="d-flex flex-row align-items-center px-3">
                                <div class="ms-1">
                                    <img src="{{  (!empty($user->avatar))? url('/Backend/assets/img/avatar/'.$user->avatar):url('/Backend/assets/img/no-image.png')  }}" alt="" class="avatar">
                                </div>
                                    <div class="ms-2">
                                        <h6 class="mb-0 text-sm">{{ $pengunjung['users']->name }}</h6>
                                        <p class="text-xs font-weight-bold mb-0">Membaca Sebanyak : {{ $pengunjung['jumlah_baca']['Selesai Baca'] > 0 ? $pengunjung['jumlah_baca']['Selesai Baca'] . ' Kali' : 'Belum Membaca' }}</p>
                                        <p class="text-xs font-weight-bold mb-0">Belum Selesai Membaca : {{ $pengunjung['jumlah_baca']['Belum Selesai Baca']  > 0 ? $pengunjung['jumlah_baca']['Belum Selesai Baca'] . ' Kali' : 'Belum Ada Buku Yang DI Baca' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{ $pengunjung['tanggal_baca'] }}</p>
                            </td>
                        </tr>
                    @endforeach

                    @if (empty($dataPengunjung))
                        <tr>
                            <td colspan="4">
                                <p class="text-center mb-2">Belum ada riwayat bacaan.</p>
                            </td>
                        </tr>
                    @endif
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
@endsection
