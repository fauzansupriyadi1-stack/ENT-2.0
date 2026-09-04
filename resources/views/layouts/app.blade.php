<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'FZAN NEWS — Thoughts That Inspire, Stories That Connect')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="site-body">
    <!-- Reading Progress Indicator -->
    <div id="scroll-progress" class="scroll-progress-bar"></div>

    <!-- Main Header -->
    <header class="main-header" id="main-header">
        <div class="container header-inner flex justify-between items-center">
            <!-- Mobile Menu Toggle Button -->
            <button class="mobile-toggle-btn" id="mobile-menu-toggle" aria-label="Toggle navigation menu">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </button>

            <!-- Brand Logo: FZAN NEWS -->
            <a href="{{ url('/') }}" class="brand-logo">
                FZAN NEWS<span class="text-accent">.</span>
            </a>
            
            <!-- Desktop Navigation -->
            <nav class="desktop-nav" aria-label="Main Navigation">
                <ul class="nav-menu">
                    <li class="nav-item active"><a href="{{ url('/') }}">Home</a></li>
                    <li class="nav-item dropdown">
                        <a href="#latest" class="scroll-link">
                            Kategori <i class="fas fa-chevron-down" style="font-size: 11px; margin-left: 4px;"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ url('/?category=Lifestyle#latest') }}" class="dropdown-item nav-cat-item" data-category="lifestyle"><i class="fas fa-leaf"></i> Lifestyle</a></li>
                            <li><a href="{{ url('/?category=Travel#latest') }}" class="dropdown-item nav-cat-item" data-category="travel"><i class="fas fa-plane"></i> Travel</a></li>
                            <li><a href="{{ url('/?category=Productivity#latest') }}" class="dropdown-item nav-cat-item" data-category="productivity"><i class="fas fa-bolt"></i> Productivity</a></li>
                            <li><a href="{{ url('/?category=Personal Growth#latest') }}" class="dropdown-item nav-cat-item" data-category="personal-growth"><i class="fas fa-seedling"></i> Personal Growth</a></li>
                            <li><a href="{{ url('/?category=Technology#latest') }}" class="dropdown-item nav-cat-item" data-category="technology"><i class="fas fa-laptop-code"></i> Technology</a></li>
                        </ul>
                    </li>
                    <li class="nav-item"><a href="#latest" class="scroll-link">Latest Articles</a></li>
                    <li class="nav-item"><a href="#about" class="scroll-link">About</a></li>
                    <li class="nav-item"><a href="{{ route('dashboard.index') }}" style="font-weight: 600; color: var(--c-teal);"><i class="fas fa-sliders-h" style="margin-right: 4px;"></i> Dashboard</a></li>
                </ul>
            </nav>

            <!-- Header Action Tools -->
            <div class="header-tools">
                <button aria-label="Search" class="btn-search-trigger" id="search-open-btn" title="Search Articles">
                    <i class="fas fa-search"></i>
                </button>
                <a href="{{ url('/login') }}" class="btn-subscribe">
                    Login
                </a>
            </div>
        </div>

        <!-- Mobile Drawer Navigation -->
        <div class="mobile-drawer" id="mobile-drawer">
            <div class="mobile-drawer-header">
                <span class="mobile-logo">FZAN NEWS<span class="text-accent">.</span></span>
                <button class="mobile-drawer-close" id="mobile-drawer-close" aria-label="Close menu">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <ul class="mobile-nav-list">
                <li><a href="{{ url('/') }}" class="mobile-nav-link active"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="#latest" class="mobile-nav-link scroll-link"><i class="fas fa-newspaper"></i> Latest Articles</a></li>
                <li style="padding: 10px 16px 4px; font-size: 11px; font-weight: 700; color: var(--c-text-muted); text-transform: uppercase; letter-spacing: 0.8px;">Kategori Berita</li>
                <li><a href="{{ url('/?category=Lifestyle#latest') }}" class="mobile-nav-link nav-cat-item" data-category="lifestyle"><i class="fas fa-leaf"></i> Lifestyle</a></li>
                <li><a href="{{ url('/?category=Travel#latest') }}" class="mobile-nav-link nav-cat-item" data-category="travel"><i class="fas fa-plane"></i> Travel</a></li>
                <li><a href="{{ url('/?category=Productivity#latest') }}" class="mobile-nav-link nav-cat-item" data-category="productivity"><i class="fas fa-bolt"></i> Productivity</a></li>
                <li><a href="{{ url('/?category=Personal Growth#latest') }}" class="mobile-nav-link nav-cat-item" data-category="personal-growth"><i class="fas fa-seedling"></i> Personal Growth</a></li>
                <li><a href="{{ url('/?category=Technology#latest') }}" class="mobile-nav-link nav-cat-item" data-category="technology"><i class="fas fa-laptop-code"></i> Technology</a></li>
                <li><a href="#about" class="mobile-nav-link scroll-link"><i class="fas fa-user"></i> About</a></li>
                <li><a href="{{ route('dashboard.index') }}" class="mobile-nav-link" style="color: var(--c-teal); font-weight: 600;"><i class="fas fa-sliders-h"></i> Dashboard</a></li>
            </ul>
            <div class="mobile-drawer-footer">
                <a href="{{ url('/login') }}" class="btn-subscribe btn-block" style="text-align: center;">
                    <i class="fas fa-sign-in-alt" style="margin-right: 8px;"></i> Login
                </a>
            </div>
        </div>
        <div class="mobile-overlay" id="mobile-overlay"></div>
    </header>

    <!-- Search Modal Overlay -->
    <div class="search-modal" id="search-modal">
        <div class="search-modal-backdrop" id="search-modal-backdrop"></div>
        <div class="search-modal-dialog">
            <div class="search-modal-header">
                <div class="search-input-wrap">
                    <i class="fas fa-search search-input-icon"></i>
                    <input type="text" id="global-search-input" placeholder="Search stories, topics, keywords..." autocomplete="off">
                    <button id="search-clear-btn" class="search-clear-btn" style="display: none;">
                        <i class="fas fa-times-circle"></i>
                    </button>
                </div>
                <button class="search-modal-close" id="search-modal-close" aria-label="Close search">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="search-modal-body">
                <div class="search-quick-tags">
                    <span class="quick-tags-label">Popular:</span>
                    <button class="quick-tag-pill" data-query="Morning">Morning</button>
                    <button class="quick-tag-pill" data-query="Travel">Travel</button>
                    <button class="quick-tag-pill" data-query="Focus">Productivity</button>
                    <button class="quick-tag-pill" data-query="Lifestyle">Lifestyle</button>
                </div>
                <div class="search-results-list" id="search-results-list">
                    <!-- Search items rendered dynamically via JS -->
                </div>
            </div>
        </div>
    </div>

    <!-- Newsletter Modal -->
    <div class="subscribe-modal" id="subscribe-modal">
        <div class="subscribe-modal-backdrop" id="subscribe-modal-backdrop"></div>
        <div class="subscribe-modal-card">
            <button class="subscribe-modal-close" id="subscribe-modal-close"><i class="fas fa-times"></i></button>
            <div class="subscribe-icon-circle">
                <i class="fas fa-envelope-open-text"></i>
            </div>
            <h3 class="subscribe-modal-title">Join Our Community</h3>
            <p class="subscribe-modal-desc">Get the freshest stories, productivity tips, and lifestyle insights delivered weekly to your inbox.</p>
            <form id="subscribe-form" class="subscribe-modal-form" onsubmit="return false;">
                <div class="subscribe-input-group">
                    <input type="email" id="subscribe-email" placeholder="Enter your email address..." required>
                    <button type="submit" class="btn-primary" id="subscribe-submit-btn">Subscribe Now</button>
                </div>
                <p class="subscribe-note"><i class="fas fa-shield-alt"></i> No spam ever. Unsubscribe anytime.</p>
            </form>
        </div>
    </div>

    <!-- Main Content Area -->
    <main>
        @yield('content')
    </main>

    <!-- Site Footer -->
    <footer class="site-footer" id="about">
        <div class="container footer-content">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="{{ url('/') }}" class="brand-logo footer-logo">
                        FZAN NEWS<span class="text-accent">.</span>
                    </a>
                    <p class="footer-bio">
                        Thoughts that inspire, stories that connect. A curated collection of lifestyle, personal growth, productivity, and modern technology.
                    </p>

                </div>


            </div>

            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} <strong>FZAN NEWS.</strong> All rights reserved.</p>
                <div class="footer-bottom-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">Cookie Settings</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back To Top Button -->
    <button id="back-to-top" class="back-to-top-btn" aria-label="Back to top">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- Toast Notification Container -->
    <div id="toast-container" class="toast-container"></div>

    <!-- Main JavaScript -->
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
