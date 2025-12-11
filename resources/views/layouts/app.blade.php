<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- CSS -->
    <link href="{{ asset('assets-admin/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-admin/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-admin/css/style.css') }}" rel="stylesheet">
</head>

<body>

    <div class="container-fluid px-4">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets-admin/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/bootstrap.js') }}"></script>
</body>
</html>
