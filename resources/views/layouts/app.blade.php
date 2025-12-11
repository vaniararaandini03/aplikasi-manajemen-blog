<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    <link href="{{ asset('assets-admin/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('assets-admin/css/font-awesome.min.css') }}" rel="stylesheet">

    <style>
        body {
            background: #f0f2f5;
            font-family: Arial, sans-serif;
        }

        /* NAVBAR ATAS */
        .top-navbar {
            width: 100%;
            background: #ffffffff;
            padding: 15px 25px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: white;
        }

        .nav-links {
            display: flex;
            gap: 25px;
        }

        .nav-links a {
            color: #05c6fcff;
            font-size: 15px;
            text-decoration: none;
            font-weight: 500;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        /* KONTEN */
        .content-area {
            margin-top: 25px;
            padding: 25px;
        }
        .title-admin {
    color: #05c6fcff;!important;
}
    </style>
</head>

<body>

    <!-- NAVBAR ATAS -->
    <div class="top-navbar">

<img src="{{ asset('assets-admin/images/logo.png') }}" 
         alt="Logo" 
         style="width:120px; height:auto; margin-right:10px;">

        <h4 class="m-0 title-admin">RUANG ARTIKEL</h4>

        <div class="nav-links">
            <a href="#"><i class="fa fa-home"></i> Home</a>
            <a href="#"><i class="fa fa-users"></i> Profile</a>
            <a href="#"><i class="fa fa-sign-out"></i> Logout</a>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content-area">
        @yield('title')
        @yield('content')
    </div>

    <script src="{{ asset('assets-admin/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('assets-admin/js/bootstrap.js') }}"></script>
</body>
</html>