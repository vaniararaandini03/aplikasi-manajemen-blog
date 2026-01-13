<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Admin – Ruang Artikel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Font ala Medium -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

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

        header h1 a {
            color: inherit;
            text-decoration: none;
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
            color: #555;
            font-weight: 500;
            border-radius: 8px;
            transition: background 0.2s, color 0.2s;
        }

        .sidebar a:hover {
            background: #f2f2f2;
            color: #000;
        }

        /* ===== ACTIVE (MEDIUM STYLE) ===== */
        .sidebar a.active {
            background: #f2f2f2;
            color: #000;
            font-weight: 600;
        }

        /* ===== MAIN CONTENT ===== */
        main {
            margin-top: 64px;
            margin-left: 220px;
            padding: 40px 32px;
            max-width: 900px;
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
    </style>

    @stack('styles')
</head>
<body>

<!-- HEADER -->
<header>
    <h1>
        <a href="{{ route('staff.articles.index') }}">Ruang Artikel</a>
    </h1>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn-logout">Logout</button>
    </form>
</header>

<!-- SIDEBAR -->
<aside class="sidebar">
    <a href="{{ route('staff.articles.index') }}"
       class="{{ Route::is('staff.articles.index') ? 'active' : '' }}">
        🏠 Dashboard
    </a>

    <a href="{{ route('staff.articles.index') }}"
       class="{{ Route::is('staff.articles.*') ? 'active' : '' }}">
        ✍️ Artikel
    </a>
</aside>

<!-- CONTENT -->
<main>
    @yield('content')
</main>

@stack('scripts')
</body>
</html>
