<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Blogr.')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-gray-50 text-gray-900 font-sans">
    <header class="main-header">
        <div class="container header-inner flex justify-between items-center py-4">
            <a href="{{ route('home') ?? '/' }}" class="brand-logo text-3xl font-serif font-bold tracking-tight">
                Blogr<span class="text-accent">.</span>
            </a>
            
            <nav class="hidden md:block">
                <ul class="nav-menu flex space-x-8 text-sm font-medium">
                    <li class="nav-item active"><a href="#">Home</a></li>
                    <li class="nav-item"><a href="#">Categories</a></li>
                    <li class="nav-item"><a href="#">About</a></li>
                    <li class="nav-item"><a href="#">Newsletter</a></li>
                    <li class="nav-item"><a href="#">Contact</a></li>
                </ul>
            </nav>

            <div class="header-tools flex items-center space-x-4">
                <button aria-label="Search" class="btn-search text-gray-500 hover:text-gray-900 transition-colors">
                    <i class="fas fa-search"></i>
                </button>
                <a href="#" class="btn-subscribe bg-accent text-white px-5 py-2 rounded-full font-medium text-sm transition hover:opacity-90 shadow-sm">
                    Subscribe
                </a>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="site-footer py-12 mt-16 text-center border-t border-gray-100">
        <div class="container">
            <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} Blogr. Designed with the requested color palette.</p>
        </div>
    </footer>
</body>
</html>
