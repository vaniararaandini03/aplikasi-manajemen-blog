<!DOCTYPE html>
<html>
<head>
    <title>Ruang Artikel</title>

    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
            background: #fff;
            margin: 0;
            color: #222;
        }

        header {
            border-bottom: 1px solid #eee;
            padding: 15px 30px;
            font-weight: bold;
            font-size: 20px;
        }

        .layout {
            max-width: 1100px;
            margin: 30px auto;
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 40px;
        }

        /* FEED */
        .article-item {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            padding: 20px 0;
            border-bottom: 1px solid #eee;
            cursor: pointer;
        }

        .article-item:hover {
            background: #f8f9fa;
        }

        .article-text h2 {
            font-size: 20px;
            margin-bottom: 6px;
        }

        .article-text p {
            color: #555;
        }

        img {
            border-radius: 6px;
            object-fit: cover;
        }

        .text-muted {
            color: #888;
            font-size: 13px;
        }

        /* SIDEBAR */
        .sidebar h4 {
            margin-bottom: 15px;
        }

        .staff-pick {
            margin-bottom: 15px;
            cursor: pointer;
        }

        .staff-pick:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<header>RUANG ARTIKEL</header>

@yield('content')

</body>
</html>
