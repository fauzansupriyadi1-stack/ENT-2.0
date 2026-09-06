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

    <!-- CSS Utama -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- CSS Layout Dashboard -->
    <link rel="stylesheet" href="{{ asset('css/dashboard-layout.css') }}">

    <!-- CSS Tambahan dari Halaman Child -->
    @yield('styles')
</head>
<body>
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <div class="dash-container">

        <!-- Sidebar Navigasi -->
        <aside class="dash-sidebar" id="dashSidebar">
            <a href="{{ route('home') }}" class="dash-brand">
                <span>FZAN NEWS<strong>.</strong></span>
                <button class="dash-toggle-btn" id="closeSidebarBtn" aria-label="Close menu">
                    <i class="fas fa-times"></i>
                </button>
            </a>

            <ul class="dash-nav">
                <li>
                    <a href="{{ route('dashboard.daftar-artikel') }}" class="{{ request()->routeIs('dashboard.daftar-artikel') ? 'active' : '' }}">
                        <i class="fas fa-th-large"></i> Kelola Artikel
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard.tambah-artikel') }}" class="{{ request()->routeIs('dashboard.tambah-artikel') ? 'active' : '' }}">
                        <i class="fas fa-plus-circle"></i> Tambah Artikel
                    </a>
                </li>
                <li class="nav-separator">
                    <a href="{{ route('home') }}" target="_blank">
                        <i class="fas fa-external-link-alt"></i> Lihat Website
                    </a>
                </li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" id="logout-form">
                        @csrf
                        <a href="#" class="nav-logout" onclick="document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Keluar (Logout)
                        </a>
                    </form>
                </li>
            </ul>
        </aside>

        <!-- Konten Utama Dashboard -->
        <main class="dash-main">

            <!-- Topbar -->
            <div class="dash-topbar">
                <button class="dash-toggle-btn" id="openSidebarBtn" aria-label="Open navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="topbar-title">
                    <i class="fas fa-shield-alt"></i>
                    <span>Admin Control Center</span>
                </div>

                <div class="user-profile-badge">
                    <img src="https://i.pravatar.cc/100?img=5" alt="Admin Avatar" class="user-avatar">
                    <div>
                        <div class="user-name">Olivia Hart</div>
                        <div class="user-role">Super Administrator</div>
                    </div>
                </div>
            </div>

            {{-- Alert sukses setelah tambah/edit/hapus artikel --}}
            @if(session('success'))
                <div class="alert-success">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            @yield('content')

        </main>
    </div>

    <!-- JavaScript Sidebar Responsif -->
    <script>
        const openBtn  = document.getElementById('openSidebarBtn');
        const closeBtn = document.getElementById('closeSidebarBtn');
        const sidebar  = document.getElementById('dashSidebar');
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

        if (openBtn)  openBtn.addEventListener('click', openSidebar);
        if (closeBtn) closeBtn.addEventListener('click', closeSidebar);
        if (backdrop) backdrop.addEventListener('click', closeSidebar);
    </script>

    @yield('scripts')
</body>
</html>
