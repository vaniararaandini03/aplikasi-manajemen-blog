<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin – Ruang Artikel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background: #f6f7fb;
            color: #222;
        }

        /* HEADER */
        header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 64px;
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            z-index: 1000;
        }

        header h1 {
            font-size: 1.2rem;
            font-weight: 600;
            margin: 0;
        }

        header a {
            text-decoration: none;
            color: inherit;
        }

        .btn-logout {
            background: none;
            border: none;
            font-size: 0.9rem;
            cursor: pointer;
            color: #555;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            top: 64px;
            left: 0;
            width: 220px;
            height: calc(100vh - 64px);
            background: #fff;
            border-right: 1px solid #e5e7eb;
            padding: 24px 16px;
        }

        .profile-box {
            text-align: center;
            margin-bottom: 24px;
        }

        .profile-box img {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            margin-bottom: 6px;
            object-fit: cover;
        }

        .profile-box h4 {
            font-size: 0.9rem;
            margin: 4px 0;
            font-weight: 600;
        }

        .profile-box span {
            font-size: 0.75rem;
            color: #777;
        }

        .sidebar a {
            display: block;
            padding: 10px 12px;
            margin-bottom: 6px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.9rem;
            color: #555;
        }

        .sidebar a:hover {
            background: #f1f5f9;
            color: #000;
        }

        .sidebar a.active {
            background: #e0ecff;
            color: #2563eb;
            font-weight: 600;
        }

        /* CONTENT */
        main {
            margin-top: 64px;
            margin-left: 220px;
            padding: 32px;
        }

        .card {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 1px 3px rgba(0,0,0,.08);
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 4px;
            display: block;
        }

        .form-control {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.9rem;
        }

        .btn {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: #2563eb;
            color: #fff;
        }

        .btn-outline {
            background: #fff;
            border: 1px solid #d1d5db;
        }
    </style>
</head>
<body>

<header>
    <h1>
        <a href="{{ route('admin.dashboard') }}">Ruang Artikel</a>
    </h1>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn-logout">Logout</button>
    </form>
</header>

<aside class="sidebar">
    <div class="profile-box">
        @if(auth()->user()->profile_image)
            <img src="{{ asset('storage/' . auth()->user()->profile_image) }}">
        @else
            <img src="https://via.placeholder.com/56x56/2563eb/ffffff?text={{ strtoupper(substr(Auth::user()->name,0,1)) }}">
        @endif
        <h4>{{ Auth::user()->name }}</h4>
        <span>{{ ucfirst(Auth::user()->role) }}</span>
    </div>

    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
    <a href="{{ route('admin.articles.index') }}" class="{{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">Artikel</a>
    <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">Kategori</a>
    <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">Pengguna</a>
    <a href="{{ route('admin.profile') }}" class="{{ request()->routeIs('admin.profile') ? 'active' : '' }}">Profil</a>
</aside>

<main>
    @yield('content')
</main>

</body>
</html>
