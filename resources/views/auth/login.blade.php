@extends('layouts.auth')

@push('style')
    <link rel="stylesheet" href="{{ asset('Backend/assets/css/argon-dashboard.min.css') }}">
@endpush

@section('content')
<div class="forms-container">
    <div class="login-register">
        <form action="{{ route('login.store') }}" class="login-form" method="POST">
            @csrf
            <h2 class="title">Login</h2>
            @if (session()->has('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger text-white pb-0" role="alert">
                    <ul>
                    @foreach ($errors->all() as $anggota )
                        <li>{{ $anggota }}</li>
                    @endforeach
                </ul>
                </div>
            @endif
        <div class="input-field">
          <i class="fas fa-user"></i>
          <input type="text" name="username" id="username" value="{{old('username')}}" placeholder="Username"/>
        </div>
        <div class="input-field">
          <i class="fas fa-lock"></i>
          <input type="password" name="password" id="password" placeholder="Password" />
        </div>
        <button type="submit" class="btn-save solid">Login</button>
      </form>

      <form action="{{ route('register.store') }}" class="register-form" method="POST">
        @csrf
        <h2 class="title">Register</h2>
        <div class="input-field">
          <i class="fas fa-user"></i>
          <input type="text" value="{{ old('username') }}" placeholder="Username" name="username" id="username"/>
        </div>
        <div class="input-field">
          <i class="fas fa-user-pen"></i>
          <input type="text" value="{{ old('name') }}" placeholder="Name" name="name" id="name" />
        </div>
        <div class="input-field">
            <i class="fa-solid fa-school-circle-check"></i>
          <select name="kelas_id">
            <option selected disabled>--- Kelas ---</option>
            @foreach ($kelas as $k)
            <option value="{{ $k->id }}">{{ $k->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="input-field">
            <i class="fa-solid fa-school-flag"></i>
          <select name="jurusan_id">
            <option selected disabled>--- Jurusan ---</option>
            @foreach ($jurusan as $j)
            <option value="{{ $j->id }}">{{ $j->name}}</option>
            @endforeach
          </select>
        </div>
        <div class="input-field">
          <i class="fas fa-envelope"></i>
          <input type="email" value="{{ old('email') }}" placeholder="Email" name="email" id="email" />
        </div>
        <div class="input-field">
          <i class="fas fa-lock"></i>
          <input type="password" placeholder="Password" name="password" id="password" />
        </div>
        <button type="submit" class="btn-save">Register</button>
      </form>
    </div>
  </div>

  <div class="panels-container">
    <div class="panel left-panel">
      <div class="content">
        <h3>Belum punya akun ?</h3>
        <p>Yuk, jadikan pengalaman membaca lebih seru! Ayo buat akunmu sekarang dan nikmati akses eksklusif!</p>
        <button class="btn-save transparent" id="login-btn">Register</button>
      </div>
      <img src="{{ asset('Frontend/assets/img/login/undraw_notebook_re_id0r.svg') }}" class="image" alt="">
    </div>

    <div class="panel right-panel">
      <div class="content">
        <h3>Sudah punya akun ?</h3>
        <p>Selamat datang kembali! Ayo, masuk ke dalam dunia literasi kami. Isi petualanganmu dengan membaca buku-buku menarik. Masuk sekarang untuk mengeksplor lebih banyak cerita yang menunggu!</p>
        <button class="btn-save transparent" id="register-btn">Login</button>
      </div>
      <img src="{{ asset('Frontend/assets/img/login/undraw_reading_time_re_phf7.svg') }}" class="image" alt="">
    </div>
  </div>
@endsection
