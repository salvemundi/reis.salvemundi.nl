<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Links for css, etc. -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"/>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">
    <!-- JavaScript Bundle with Popper -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://kit.fontawesome.com/a6479d1508.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <title>{{ config('app.name', 'Laravel') }}</title>
    {{-- Favicons --}}
    <link rel="shortcut icon" href="{{ asset('images/favicons/favicon.ico') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicons/apple-touch-icon.png') }}">
    <link rel="icon" href="{{ asset('images/favicons/favicon.ico') }}">
    <link rel="icon" sizes="32x32" href="{{ asset('images/favicons/favicon-32x32.png') }}">
    <link rel="icon" sizes="16x16" href="{{ asset('images/favicons/favicon-16x16.png') }}">
</head>
<body id="body" style="padding-left: 0px; padding-right: 0px;">
    <div id="app">
        @include('include/navbarGuapp')
        @yield('content')
        @include('include/footer')
    </div>
</body>
</html>
