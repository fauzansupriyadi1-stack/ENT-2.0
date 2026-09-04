<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin | FZAN NEWS')</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <style>
        :root {
            --dash-bg: #f8fafc;
            --dash-card: #ffffff;
            --dash-sidebar: #06231D;
            --c-teal: #076653;
            --c-teal-hover: #054f40;
            --c-teal-light: rgba(7, 102, 83, 0.08);
            --c-lime: #E3EF26;
            --c-border-light: #e2e8f0;
            --radius-md: 14px;
            --transition-smooth: 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        body {
            background-color: var(--dash-bg);
            font-family: 'Inter', sans-serif;
            color: #1e293b;
        }

        .dash-container {
            display: flex;
            min-height: 100vh;
            position: relative;
        }

        /* Sidebar Styling */
        .dash-sidebar {
            width: 260px;
            background-color: var(--dash-sidebar);
            color: #ffffff;
            padding: 28px 20px;
            display: flex;
            flex-direction: column;
            flex-shrink: 0;
            z-index: 100;
            transition: transform var(--transition-smooth);
        }

        .dash-brand {
            font-family: 'Playfair Display', serif;
            font-size: 26px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 36px;
            padding: 0 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-decoration: none;
        }

        .dash-brand span {
            color: var(--c-lime);
        }

        .dash-nav {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .dash-nav a {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 18px;
            border-radius: 12px;
            color: rgba(255, 255, 255, 0.75);
            font-weight: 500;
            font-size: 14.5px;
            transition: all var(--transition-smooth);
            text-decoration: none;
        }

        .dash-nav a:hover, .dash-nav a.active {
            background-color: var(--c-teal);
            color: #ffffff;
            transform: translateX(4px);
            box-shadow: 0 4px 14px rgba(7, 102, 83, 0.4);
        }

        .dash-nav a i {
            width: 20px;
            font-size: 16px;
        }

        /* Main Content */
        .dash-main {
            flex: 1;
            padding: 32px 40px;
            overflow-y: auto;
            max-width: 100%;
        }

        .dash-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 32px;
            background: #ffffff;
            padding: 14px 24px;
            border-radius: var(--radius-md);
            border: 1px solid var(--c-border-light);
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        }

        .dash-toggle-btn {
            display: none;
            background: transparent;
            border: none;
            font-size: 20px;
            color: var(--c-teal);
            cursor: pointer;
            padding: 4px 8px;
        }

        .user-profile-badge {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--c-teal);
        }

        /* Responsive Breakpoints */
        @media (max-width: 992px) {
            .dash-sidebar {
                position: fixed;
                top: 0;
                left: -280px;
                height: 100vh;
                width: 260px;
            }
            .dash-sidebar.open {
                transform: translateX(280px);
                box-shadow: 0 10px 40px rgba(0,0,0,0.3);
            }
            .dash-toggle-btn {
                display: block;
            }
            .dash-main {
                padding: 20px 16px;
            }
        }

        .sidebar-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(6, 35, 29, 0.5);
            backdrop-filter: blur(4px);
            z-index: 99;
        }
        .sidebar-backdrop.active {
            display: block;
        }

        /* Interactive Animations */
        .stat-box {
            background: #ffffff;
            border-radius: var(--radius-md);
            padding: 24px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.03);
            border: 1px solid var(--c-border-light);
            transition: all var(--transition-smooth);
        }
        .stat-box:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(7, 102, 83, 0.1);
            border-color: rgba(7, 102, 83, 0.3);
        }
    </style>
</head>
<body>
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <div class="dash-container">
        <!-- Sidebar Navigation -->
        <aside class="dash-sidebar" id="dashSidebar">
            <a href="{{ route('home') }}" class="dash-brand">
                <span>FZAN NEWS<strong style="color: var(--c-lime);">.</strong></span>
                <button class="dash-toggle-btn" id="closeSidebarBtn" style="color: #fff; display: none;" aria-label="Close menu"><i class="fas fa-times"></i></button>
            </a>
            <ul class="dash-nav">
                <li>
                    <a href="{{ route('dashboard.index') }}" class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                        <i class="fas fa-th-large"></i> Kelola Artikel
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.create') }}" class="{{ request()->routeIs('dashboard.create') ? 'active' : '' }}">
                        <i class="fas fa-plus-circle"></i> Tambah Artikel
                    </a>
                </li>
                <li style="margin-top: 32px; border-top: 1px solid rgba(255,255,255,0.12); padding-top: 20px;">
                    <a href="{{ route('home') }}" target="_blank">
                        <i class="fas fa-external-link-alt"></i> Lihat Website
                    </a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" id="logout-form">
                        @csrf
                        <a href="#" onclick="document.getElementById('logout-form').submit();" style="color: #f87171;">
                            <i class="fas fa-sign-out-alt"></i> Keluar (Logout)
                        </a>
                    </form>
                </li>
            </ul>
        </aside>

        <!-- Main Dashboard Content -->
        <main class="dash-main">
            <!-- Topbar Header -->
            <div class="dash-topbar">
                <button class="dash-toggle-btn" id="openSidebarBtn" aria-label="Open navigation">
                    <i class="fas fa-bars"></i>
                </button>
                <div style="font-weight: 600; font-size: 15px; color: var(--c-teal); display: flex; align-items: center; gap: 8px;">
                    <i class="fas fa-shield-alt"></i> <span>Admin Control Center</span>
                </div>
                <div class="user-profile-badge">
                    <img src="https://i.pravatar.cc/100?img=5" alt="Admin Avatar" class="user-avatar">
                    <div style="display: flex; flex-direction: column;">
                        <span style="font-weight: 700; font-size: 13.5px;">Olivia Hart</span>
                        <span style="font-size: 11px; color: #64748b;">Super Administrator</span>
                    </div>
                </div>
            </div>

            @if(session('success'))
                <div class="alert-success" style="background: #E2FBCE; color: #0C342C; padding: 14px 20px; border-radius: 12px; margin-bottom: 24px; font-weight: 600; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.03);">
                    <i class="fas fa-check-circle" style="font-size: 18px; color: var(--c-teal);"></i> {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Responsive Sidebar JS -->
    <script>
        const openBtn = document.getElementById('openSidebarBtn');
        const closeBtn = document.getElementById('closeSidebarBtn');
        const sidebar = document.getElementById('dashSidebar');
        const backdrop = document.getElementById('sidebarBackdrop');

        function openSidebar() {
            sidebar.classList.add('open');
            backdrop.classList.add('active');
            if (closeBtn) closeBtn.style.display = 'block';
        }

        function closeSidebar() {
            sidebar.classList.remove('open');
            backdrop.classList.remove('active');
        }

        if (openBtn) openBtn.addEventListener('click', openSidebar);
        if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
        if (backdrop) backdrop.addEventListener('click', closeSidebar);
    </script>

    @yield('scripts')
</body>
</html>
