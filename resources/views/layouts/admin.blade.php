<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #fafafa;
            margin: 0;
        }

        /* Navbar */
        .navbar {
            height: 56px;
            border-bottom: 1px solid #eee;
        }

        /* Sidebar */
        #sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100%;
            background: #fff;
            border-right: 1px solid #eee;
            transform: translateX(-100%);
            transition: 0.3s ease;
            z-index: 1050;
            padding-top: 70px;
        }

        #sidebar ul {
            padding: 0;
            margin: 0;
            list-style: none;
        }

        #sidebar li {
            padding: 12px 24px;
        }

        #sidebar li:hover {
            background: #f5f5f5;
        }

        .sidebar-link {
            text-decoration: none;
            color: #000;
            display: block;
            font-weight: 500;
        }

        /* Overlay */
        #overlay {
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            opacity: 0;
            pointer-events: none;
            transition: 0.3s;
            z-index: 1040;
        }

        /* Active */
        #sidebar.active {
            transform: translateX(0);
        }

        #overlay.active {
            opacity: 1;
            pointer-events: all;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-light bg-light px-4">
        <button id="menuBtn" class="btn btn-link fs-4 text-dark me-3">☰</button>
        <span class="navbar-brand fw-bold">RUANG ARTIKEL</span>
    </nav>

    <!-- Overlay -->
    <div id="overlay"></div>

    <!-- Sidebar -->
    <aside id="sidebar">
        <ul>
            <li><a href="#" class="sidebar-link">🏠 Home</a></li>
            <li><a href="#" class="sidebar-link">📚 Library</a></li>
            <li><a href="#" class="sidebar-link">👤 Profile</a></li>
            <li><a href="#" class="sidebar-link">✍️ Write</a></li>
            <li><a href="#" class="sidebar-link">⚙️ Settings</a></li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="container-fluid mt-4">
        @yield('content')
    </main>

    <!-- Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menuBtn = document.getElementById('menuBtn');
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');

            menuBtn.addEventListener('click', () => {
                sidebar.classList.add('active');
                overlay.classList.add('active');
            });

            overlay.addEventListener('click', () => {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });
        });
    </script>

</body>
</html>
