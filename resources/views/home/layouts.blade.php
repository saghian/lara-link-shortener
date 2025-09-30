<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="{{ asset('/panel/img/logo/icon.ico') }}">
    <title>@yield('title', 'Lara Link Shortener')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-image: url('{{ asset('/main/img/bg.avif') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        .header-blur {
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.1);
        }

        .mobile-menu {
            transform: translateX(100%);
            transition: transform 0.3s ease-in-out;
        }

        .mobile-menu-open {
            transform: translateX(0);
        }

        .hamburger-line {
            transition: all 0.3s ease;
        }

        .hamburger-active .hamburger-line:nth-child(1) {
            transform: rotate(45deg) translate(6px, 6px);
        }

        .hamburger-active .hamburger-line:nth-child(2) {
            opacity: 0;
        }

        .hamburger-active .hamburger-line:nth-child(3) {
            transform: rotate(-45deg) translate(6px, -6px);
        }
    </style>
</head>

<body class="min-h-screen font-sans">
    <!-- Header -->
    <header class="header-blur shadow-sm">
        <nav class="container mx-auto px-4 py-3">
            <div class="flex justify-between items-center">
                <!-- Logo Left -->
                <div class="flex items-center space-x-3">
                    <div
                        class="w-10 h-10 bg-gradient-to-r from-slate-50 to-fuchsia-50 rounded-lg flex items-center justify-center shadow">
                        <img src="{{ asset('/panel/img/logo/icon.png') }}" alt="">
                    </div>
                    <span class="text-white text-lg font-bold">Lara Link Shortener</span>
                </div>

                <!-- Desktop Menu - Hidden on mobile -->
                <div class="hidden md:block">
                    @auth
                        <div class="flex items-center space-x-4">
                            <span class="text-white text-sm bg-white/20 px-3 py-1 rounded">
                                {{ Auth::user()->name }}
                            </span>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded text-sm transition">
                            Sign In
                        </a>
                    @endauth
                </div>

                <!-- Hamburger Button - Mobile only -->
                <div class="md:hidden">
                    <button id="hamburger-btn" class="flex flex-col space-y-1 w-6 h-6 justify-center items-center">
                        <span class="hamburger-line w-5 h-0.5 bg-white rounded"></span>
                        <span class="hamburger-line w-5 h-0.5 bg-white rounded"></span>
                        <span class="hamburger-line w-5 h-0.5 bg-white rounded"></span>
                    </button>
                </div>
            </div>
        </nav>
    </header>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu" class="mobile-menu fixed inset-0 bg-black/95 z-50 md:hidden">
        <div class="flex justify-end p-4">
            <button id="close-menu" class="text-white p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="flex flex-col items-center justify-start pt-16 h-full space-y-6 px-4">
            @auth
                <!-- User Info -->
                <div class="text-center mb-8">
                    <div
                        class="w-16 h-16 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full flex items-center justify-center mx-auto mb-3">
                        <span class="text-white font-bold text-lg">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <h3 class="text-white font-semibold">{{ Auth::user()->name }}</h3>
                    <p class="text-gray-300 text-sm mt-1">Welcome back!</p>
                </div>

                <!-- Menu Items -->
                <a href="{{ route('console.index') }}"
                    class="w-full bg-white/10 text-white text-center py-3 rounded-lg backdrop-blur-sm transition hover:bg-white/20">
                    Dashboard
                </a>
                <a href="{{ route('console.index') }}"
                    class="w-full bg-white/10 text-white text-center py-3 rounded-lg backdrop-blur-sm transition hover:bg-white/20">
                    My Profile
                </a>
                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-lg transition">
                        Logout
                    </button>
                </form>
            @else
                <!-- Guest Menu -->
                <div class="text-center mb-8">
                    <h3 class="text-white text-xl font-bold mb-2">Welcome</h3>
                    <p class="text-gray-300">Sign in to your account</p>
                </div>

                <a href="{{ route('login') }}"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white text-center py-3 rounded-lg transition font-semibold">
                    Sign In
                </a>
                <a href="/"
                    class="w-full bg-white/10 text-white text-center py-3 rounded-lg backdrop-blur-sm transition hover:bg-white/20">
                    Home
                </a>
            @endauth
        </div>
    </div>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <script>
        // Mobile Menu Functionality
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const closeMenuBtn = document.getElementById('close-menu');
        const mobileMenu = document.getElementById('mobile-menu');

        function toggleMobileMenu() {
            const isOpen = mobileMenu.classList.toggle('mobile-menu-open');
            hamburgerBtn.classList.toggle('hamburger-active');
            document.body.style.overflow = isOpen ? 'hidden' : '';
        }

        // Event Listeners
        hamburgerBtn.addEventListener('click', toggleMobileMenu);
        closeMenuBtn.addEventListener('click', toggleMobileMenu);

        // Close menu on link clicks
        mobileMenu.querySelectorAll('a, button').forEach(element => {
            element.addEventListener('click', (e) => {
                if (e.target.tagName === 'A' || e.target.type === 'submit') {
                    setTimeout(toggleMobileMenu, 100);
                }
            });
        });

        // Close on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && mobileMenu.classList.contains('mobile-menu-open')) {
                toggleMobileMenu();
            }
        });
    </script>
</body>

</html>
