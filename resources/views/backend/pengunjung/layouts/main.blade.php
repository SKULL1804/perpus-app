<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <!--  baca -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"></script>
    {{-- Jquary--}}
    <script src="{{ asset('jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.12.313/pdf.min.js"></script>
    @include('backend.pengunjung.partials.style')
    @stack('style')

    <title>
        {{ $title }} | Perpustakaan
    </title>
</head>
<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 bg-success position-absolute w-100"></div>

    <!-- Sidebar -->
    @include('backend.pengunjung.partials.sidebar')
    <!-- End Sidebar -->

    @yield('main')

    @include('backend.pengunjung.partials.script')
    @stack('script')

</body>
</html>

