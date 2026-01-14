<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin – Ruang Artikel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: #fff;
            color: #242424;
        }

        /* ===== HEADER ===== */
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

        header h1 {
            font-family: 'Merriweather', serif;
            font-size: 1.4rem;
            margin: 0;
            font-weight: 700;
        }

        header a {
            color: inherit;
            text-decoration: none;
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

        .btn-logout {
            background: none;
            border: none;
            color: #555;
            font-weight: 500;
            cursor: pointer;
        }

        .btn-logout:hover {
            color: #000;
        }

        /* ===== SIDEBAR ===== */
        .sidebar {
            position: fixed;
            top: 64px;
            left: 0;
            width: 220px;
            height: calc(100vh - 64px);
            border-right: 1px solid #eee;
            padding: 24px 16px;
            background: #fff;
        }

        .sidebar a {
            display: block;
            padding: 10px 12px;
            margin-bottom: 6px;
            text-decoration: none;
            color: #6b6b6b;
            font-weight: 500;
            border-radius: 8px;
            transition: background 0.2s, color 0.2s;
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

        /* ===== CONTENT ===== */
        main {
            margin-top: 64px;
            margin-left: 220px;
            padding: 40px 32px;
            max-width: 1000px;
        }
    </style>
</head>
<body>

<!-- HEADER -->
<header>
    <h1>
        <a href="{{ route('staff.dashboard') }}">Ruang Artikel</a>
    </h1>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn-logout">Logout</button>
    </form>
</header>

<!-- SIDEBAR ADMIN -->
<aside class="sidebar">
    <!-- PROFILE BOX -->
    <div class="profile-box">
        @if(auth()->user()->profile_image)
            <img src="{{ asset('storage/' . auth()->user()->profile_image) }}" alt="Admin Avatar">
        @else
            <img src="https://via.placeholder.com/64x64/1a73e8/ffffff?text={{ strtoupper(substr(Auth::user()->name, 0, 1)) }}" alt="Admin Avatar">
        @endif
        <h4>{{ Auth::user()->name }}</h4>
        <span>Administrator</span>
    </div>

    <!-- NAVIGATION -->
    <a href="{{ route('admin.dashboard') }}"
       class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        🏠 Dashboard
    </a>

    <a href="{{ route('admin.articles.index') }}"
       class="{{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
        ✍️ Artikel
    </a>

    <a href="{{ route('admin.categories.index') }}"
       class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
        📂 Kategori
    </a>

    <a href="{{ route('admin.users.index') }}"
       class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
        👥 Pengguna
    </a>

    <a href="{{ route('admin.profile') }}"
       class="{{ request()->routeIs('admin.profile') ? 'active' : '' }}">
        👤 Profil
    </a>
</aside>

<!-- CONTENT -->
<main>
    @yield('content')
</main>

</body>
</html>
