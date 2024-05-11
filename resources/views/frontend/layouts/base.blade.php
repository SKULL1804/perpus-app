<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('Backend/assets/img/apple-icon.png') }}" />
    <link rel="icon" type="image/png" href="{{ asset('Backend/assets/img/apple-icon.png') }}" />
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    @include('frontend.partials.style')
    @stack('style')

    <title>
        {{ $title }} | Perpustakaan
    </title>
</head>
<body>
    {{-- <div class="loader-container">
        <div class="loader"></div>
    </div> --}}
    <!-- Header -->
    @include('frontend.partials.header')
    <!-- End Header -->

    @yield('main')

    <!-- Footer -->
    @include('frontend.partials.footer')


    <!-- End Footer -->
    @include('frontend.partials.script')
    @stack('script')


</body>
</html>

