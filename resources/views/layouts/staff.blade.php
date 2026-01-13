<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard Staff')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: #f7f8fa;
            color: #242424;
        }

        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 64px;
            background: #fff;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            z-index: 1000;
        }

        header a {
            text-decoration: none;
            color: #111;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .btn-logout {
            border: none;
            background: none;
            cursor: pointer;
            font-weight: 500;
            color: #555;
        }

        .sidebar {
            position: fixed;
            top: 64px;
            left: 0;
            width: 240px;
            height: calc(100vh - 64px);
            background: #fff;
            border-right: 1px solid #eee;
            padding: 20px 16px;
        }

        .profile-box {
            text-align: center;
            padding-bottom: 16px;
            border-bottom: 1px solid #eee;
            margin-bottom: 16px;
        }

        .profile-box img {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            margin-bottom: 8px;
        }

        .profile-box h4 {
            margin: 6px 0 2px;
            font-size: 0.95rem;
            font-weight: 600;
        }

        .profile-box span {
            font-size: 0.8rem;
            color: #777;
        }

        .sidebar a {
            display: block;
            padding: 10px 12px;
            margin-bottom: 6px;
            text-decoration: none;
            color: #6b6b6b;
            border-radius: 8px;
            font-weight: 500;
        }

        .sidebar a:hover {
            background: #f2f2f2;
            color: #000;
        }

        .sidebar a.active {
            background: #e8f3ff;
            color: #1a73e8;
            font-weight: 600;
        }

        main {
            margin-top: 64px;
            margin-left: 240px;
            padding: 32px;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 6px 18px rgba(0,0,0,.04);
        }

        .number {
            font-size: 2rem;
            font-weight: 700;
            margin-top: 8px;
        }
    </style>
</head>
<body>

<header>
    <a href="{{ route('staff.dashboard') }}">Ruang Artikel</a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn-logout">Logout</button>
    </form>
</header>

<aside class="sidebar">

    <div class="profile-box">
        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=1a73e8&color=fff">
        <h4>{{ auth()->user()->name }}</h4>
        <span>Staff</span>
    </div>

    <a href="{{ route('staff.dashboard') }}"
       class="{{ request()->routeIs('staff.dashboard') ? 'active' : '' }}">
        🏠 Dashboard
    </a>

    <a href="{{ route('staff.articles.index') }}"
       class="{{ request()->routeIs('staff.articles.*') ? 'active' : '' }}">
        ✍️ Artikel
    </a>

    <a href="{{ route('staff.profile') }}"
       class="{{ request()->routeIs('staff.profile') ? 'active' : '' }}">
        👤 Profil Saya
    </a>

</aside>

<main>
    @yield('content')
</main>

</body>
</html>
