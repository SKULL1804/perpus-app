@extends('frontend.layouts.app')

@section('content')
<!-- About -->
<section id="about" class="d-flex align-items-center">
    <div class="container g-5 vh-100">
        <div class="row align-items-center h-100">
            <div class="col-lg-6 pt-md-5 pt-lg-0 mt-lg-0 mt-4">
                <h1>{{ $about->judul }} <span>{{ $about->sub_judul }}</span></h1>
                <p>{{ $about->deskripsi }}</p>
                <a href="{{ route('login') }}" class="login-btn">Login</a>
                </div>
                <div class="col-lg-6">
                <div class="image">
                    <img src="Backend/assets/img/about/{{ $about->image_about }}" alt="" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End About -->

<!-- New seller book -->
<section id="new" class="new my-md-5 my-lg-0">
    <div class="container p-3">
        <h1>New Book</h1>
        <div class="row py-2">
            @foreach ($newBook as $nB )
            <div class="col-lg-4 col-md-6 mt-lg-0 mt-2 mt-lg-0 mt-md-0">
                <div class="card h-100">
                    <div class="d-flex justify-content-center">
                        <h2 class="title-view m-4 mb-0">{{ $nB->judul }}</h2>
                        <div class="view text-center mt-4">
                            <a href="{{ route('login') }}" class="me-4"><i class="bi bi-arrow-up-right"></i></a>
                        </div>
                    </div>
                    <div class="card-body pt-0 px-0">
                        <div class="img-book p-2">
                        <img src="Backend/assets/img/daftar-buku/{{ $nB->image_buku }}" alt="" class="card-img-top" />
                        </div>
                        <p class="card-title mt-2 mb-0 text-center">{{ $nB->pengarang }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- End New seller book -->

<!-- Best Book -->
<section id="best" class="best py-3">
<div class="container p-3">
    <h1>Best Book</h1>
    <div class="row py-2">
        @foreach ($bestBook as $bB )
        @if ($bB['jumlah_baca'] > 0)
        <div class="col-lg-4 col-md-6 mt-lg-0 mt-2 mt-lg-0 mt-md-0">
            <div class="card h-100">
            <div class="d-flex align-items-center">
                <h2 class="m-4 mb-0">{{ $bB['judul_buku'] }}</h2>
                <div class="view text-center mt-4">
                <a href="{{ route('login') }}" class="me-4"><i class="bi bi-arrow-up-right"></i></a>
                </div>
            </div>
            <div class="card-body pt-0 px-0">
                <div class="img-book p-2">
                <img src="{{ asset('/Backend/assets/img/daftar-buku/' . $bB['image']) }}" alt="{{ $bB['judul_buku'] }} class="card-img-top" />
                </div>
                <p class="card-title mt-2 mb-0 text-center">{{ $bB['pengarang'] }}</p>
            </div>
            </div>
        </div>
        @endif
        @endforeach
</div>
</section>
<!-- Best Seller -->

<!-- Kegiatan -->
<section id="kegiatan" class="kegiatan py-4">
<h1 class="pb-4">Kegiatan</h1>
<div class="container">
    <div class="row py-2 py-lg-3">
        <div class="col-md-6">
            <div class="row pb-md-2">
                <div class="col-12 p-5">
                    <label class="form-label mx-3 mb-0">Nama Kegiatan : <span>{{ $kegiatan->judul_kegiatan }}</span></label>
                    <label class="form-label mx-3 mb-0">Deskripsi Kegiatan : <span>{{ $kegiatan->deskripsi_kegiatan }}</span></label>
                    <label class="form-label mx-3 mb-0">Tempat : <span>{{ $kegiatan->tempat }}</span></label>
                    <label class="form-label mx-3 mb-0">Tanggal : <span>{{ $kegiatan->tanggal }}</span></label>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="img-kegiatan">
                <img src="Backend/assets/img/kegiatan/{{ $kegiatan->image_kegiatan }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
</div>
</div>
</section>
@endsection
