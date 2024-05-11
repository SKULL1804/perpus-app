@extends('backend.pengunjung.layouts.app')

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
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Buku Yang Telah Dibaca</p>
                    <h5 class="font-weight-bolder">{{ $jumlahBukuSelesaiBaca }}</h5>
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
      </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
              <div class="card-header pb-0 p-3">
                <h6 class="mb-0">History</h6>
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
                    @foreach ($historyBaca as $h)
                        <tr>
                            <td>
                                <div class="d-flex flex-row align-items-center px-3">
                                    <div class="ms-3">
                                        <img src="{{ asset('Backend/assets/img/daftar-buku/' . $h->daftarBuku->image_buku) }}" alt="Buku" class="img-fluid rounded" width="50">
                                    </div>
                                    <div class="ms-2">
                                        <h6 class="mb-0 text-sm">{{ $h->daftarBuku->judul }}</h6>
                                        <p class="text-xs text-secondary mb-0">{{ $h->daftarBuku->pengarang }}</p>
                                        @if ($h->ketBuku)
                                            <p class="text-xs text-secondary mb-0">Status Bacaan: {{ $h->ketBuku->status }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{ $h->tanggal_baca }}</p>
                            </td>
                        </tr>
                    @endforeach
                    @if ($historyBaca->isEmpty())
                        <tr>
                            <td colspan="2">
                                <p class="text-center mb-2">Belum ada riwayat bacaan.</p>
                            </td>
                        </tr>
                    @endif

                  </tbody>
                </table>
              </div>
            </div>
          </div>
    </div>
</div>
@endsection

