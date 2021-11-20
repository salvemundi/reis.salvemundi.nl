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
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
    <script src="https://kit.fontawesome.com/a6479d1508.js" crossorigin="anonymous"></script>
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body id="body-pd">
    <div id="app">
    @yield('content')
    </div>
</body>
</html>
