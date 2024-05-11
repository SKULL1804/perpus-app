@extends('backend.pengunjung.layouts.app')

@section('content')
<div class="container-fluid py-4">
    @if (empty($search))
    <!-- Bagian "New Book" akan ditampilkan hanya jika tidak ada pencarian -->
    <div class="row swiper pb-md-2 pd-3">
        <div class="col-md-6 col-auto">
            <div class="slide-content">
                <div class="swiper-wrapper">
                    @foreach ($newBook as $nB )
                    <div class="card mb-3 swiper-slide w-100">
                        <div class="row g-0">
                            <div class="col-md-4 col-6">
                                <img src="Backend/assets/img/new-book/{{ $nB->image_new_book }}" class="card-img img-fluid rounded-start p-md-3 p-4" alt="...">
                            </div>
                            <div class="col-md-8 col-6">
                                <div class="card-body d-flex flex-column">
                                    <div class="h-100">
                                        <h5 class="card-title text-uppercase text-bold">{{ $nB->judul }}</h5>
                                        <h3 class="card-title fs-6 text-secondary">{{ $nB->pengarang }}</h3>
                                        <h3 class="card-title fs-6 text-secondary">Penerbit</h3>
                                        <p class="card-text">Kategori</p>
                                    </div>
                                    <div class="ms-auto">
                                        <button type="button" class="btn btn-primary mt-4 mb-0">Membaca</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="swiper-button-prev">
                <i class="fa-solid fa-chevron-left"></i>
            </div>
            <div class="swiper-button-next">
                <i class="fa-solid fa-chevron-right"></i>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    @endif

    <div class="row py-3">
        @if (!empty($search))
        <h3 class="fs-3 text-white">Daftar Buku</h3>
        @else
        <h3 class="fs-3 text-white">Daftar Buku</h3>
        @endif
        @foreach ($daftarBuku as $dB )
        <div class="col-md-6">
            <div class="card mb-3 w-100">
                <div class="row g-0 max-height-300">
                    <div class="col-md-4 col-6">
                        <img src="Backend/assets/img/daftar-buku/{{ $dB->image_buku }}" class="card-img img-fluid rounded-start p-md-3 p-4" alt="...">
                    </div>
                    <div class="col-md-8 col-6">
                        <div class="card-body d-flex flex-column">
                            <div class="h-100">
                                <h5 class="card-title text-uppercase text-bold fs-6">{{ $dB->judul }}<h5>
                                <h3 class="card-title fs-6 text-secondary d-none d-md-inline d-md-flex">{{ $dB->pengarang }}</h3>
                                <h3 class="card-title fs-6 text-secondary d-none d-md-inline d-md-flex">{{ $dB->penerbit }}</h3>
                                <p class="card-text mb-0 mb-md-1">{{ $dB->kategoriBuku->name }}</p>
                                <p class="card-text"><small class="text-muted">Last updated {{ $dB->updated_at->diffForHumans() }}</small></p>
                            </div>
                            <div class="ms-md-auto">
                                @php
                                $historyBaca = $dB->historyBaca->where('id_user', auth()->id())->first();
                                $statusBaca = $historyBaca ? $historyBaca->ketBuku->status : 'Belum Baca';
                                @endphp
                                @if (!auth()->check() || $statusBaca == 'Belum Baca')
                                    <a href="{{ route('home-baca.index', ['id' => $dB->id]) }}" class="btn btn-primary">Mulai Baca</a>
                                @elseif ($statusBaca == 'Belum Selesai Baca')
                                    <a href="{{ route('lanjutkan-baca', ['id' => $dB->id]) }}" class="btn btn-primary">Lanjutkan Baca</a>
                                @elseif ($statusBaca == 'Selesai Baca')
                                    <p>Status Bacaan: {{ $statusBaca }}</p>
                                @else
                                    <a href="{{ route('home-baca.index', ['id' => $dB->id]) }}" class="btn btn-primary">
                                       Mulai Baca
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div class="px-4 pt-2">
            {!! $daftarBuku->appends(Request::except('page'))->render('vendor.pagination.bootstrap-5') !!}
        </div>
    </div>
</div>

@endsection

