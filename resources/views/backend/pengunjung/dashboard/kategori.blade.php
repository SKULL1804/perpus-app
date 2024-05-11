@extends('backend.pengunjung.layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row py-3">
        <h3 class="fs-3 text-white">{{ $selectedCategory->name }}</h3>
        @if (count($daftarBuku))
        @foreach ($daftarBuku as $dB )
        <div class="col-md-6">
            <div class="card mb-3 w-100">
                <div class="row g-0 max-height-300">
                    <div class="col-md-4 col-6">
                        <img src="{{ asset('Backend/assets/img/daftar-buku/' . $dB->image_buku) }}" class="card-img img-fluid rounded-start p-md-3 p-4" alt="...">
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
                                <button type="button" class="btn btn-primary mt-4 mb-0"><a href="{{ route('home-baca.index', $dB->id ) }}" class="text-white">Membaca</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
            <div class="col-12">
                <div class="card mb-3 w-100">
                    <h1 class="fs-2 text-center p-2">Buku belum tersedia</h1>
                </div>
            </div>
        @endif
        <div class="px-4 pt-2">
            {!! $daftarBuku->appends(Request::except('page'))->render('vendor.pagination.bootstrap-5') !!}
        </div>
    </div>
</div>
@endsection
