@extends('backend.admin.layouts.main')

@section('main')
<main class="main-content position-relative border-radius-lg">
    <!-- Navbar -->
    @include('backend.admin.partials.navbar')
    <!-- End Navbar -->
    @yield('content')
</main>
@endsection
