<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('Backend/assets/img/apple-icon.png') }}" />
        <link rel="icon" type="image/png" href="{{ asset('Backend/assets/img/apple-icon.png') }}" />
        <title>{{$title}} | Perpustakaan</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <script src="https://kit.fontawesome.com/27745149da.js" crossorigin="anonymous"></script>
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset("Frontend/assets/css/login.css") }}">
        @stack('style')
    </head>
    <body>
        <div class="container-login">
            @yield('content')
        </div>

        <!-- Script -->
        <script src="{{ asset('js/auth/login.js') }}"></script>
    </body>
</html>
