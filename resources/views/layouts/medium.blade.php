<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Ruang Artikel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Google Fonts Mirip Medium -->
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@300;400;700&family=Open+Sans&display=swap" rel="stylesheet" />

    <style>
        body {
            font-family: 'Merriweather', serif;
            margin: 0;
            background: #f6f6ef;
            color: #333;
            line-height: 1.6;
        }

        header {
            background: white;
            padding: 15px 30px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            font-family: 'Merriweather', serif;
            font-weight: 700;
            font-size: 1.8rem;
            margin: 0;
            color: #000;
        }

        nav a {
            text-decoration: none;
            color: #555;
            margin-left: 20px;
            font-weight: 600;
        }

        nav a:hover {
            color: #000;
        }

        main {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
            background: white;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
            border-radius: 8px;
        }

        article {
            margin-bottom: 40px;
            border-bottom: 1px solid #eee;
            padding-bottom: 30px;
        }

        article:last-child {
            border: none;
            margin-bottom: 0;
        }

        article h2 {
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 10px;
            color: #333;
        }

        article p.excerpt {
            font-family: 'Open Sans', sans-serif;
            font-weight: 300;
            font-size: 1rem;
            color: #666;
            margin-bottom: 10px;
        }

        article .meta {
            font-size: 0.9rem;
            color: #999;
        }

        .btn {
            background: #00ab6b;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background: #008a54;
        }
    </style>

    @stack('styles')
</head>
<body>
    <header>
        <h1><a href="{{ url('/') }}" style="color: inherit; text-decoration:none;">Ruang Artikel</a></h1>
        <nav>
            @guest
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @else
                <span>Hi, {{ auth()->user()->name }}!</span>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn" style="background:#e0245e;">Logout</button>
                </form>
            @endguest
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
