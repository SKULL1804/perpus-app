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
    <!--  JQUERY -->
    <script src="{{ asset('jquery/jquery-3.7.1.min.js') }}"></script>
    <!-- CSS  -->
    @include('backend.super-admin.partials.style')
    @stack('style')

    <title>
        {{ $title }} | Dashboard
    </title>
</head>
<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 bg-success position-absolute w-100"></div>

    <!-- Sidebar -->
    @include('backend.super-admin.partials.sidebar')
    <!-- End Sidebar -->

    @yield('main')

    <!-- JS -->
    @include('backend.super-admin.partials.script')
    @stack('script')

</body>
</html>

