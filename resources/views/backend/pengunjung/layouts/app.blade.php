@extends('backend.pengunjung.layouts.main')

@section('main')
<main class="main-content position-relative border-radius-lg">
    <!-- Navbar -->
    @include('backend.pengunjung.partials.navbar')
    <!-- End Navbar -->
    @yield('content')
</main>
@endsection
