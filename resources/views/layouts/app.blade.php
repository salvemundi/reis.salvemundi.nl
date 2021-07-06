<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Links for css, etc. -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"/>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body id="body-pd">
    <div id="app">
    @include('include/sidebar')
    @yield('content')
    @include('include/footer')
    </div>
</body>
</html>
