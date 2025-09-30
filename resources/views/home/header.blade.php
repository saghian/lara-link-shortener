<header class="header-blur shadow-lg">
    <nav class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <div class="logo-gradient w-12 h-12 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <div class="flex flex-col">
                    <span class="text-white text-xl font-bold">CodePanel</span>
                    <span class="text-gray-300 text-xs hidden sm:block">Development Platform</span>
                </div>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:block">
                @auth
                    @include('layouts.partials.user-menu')
                @else
                    <a href="{{ route('login') }}"
                        class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-6 py-3 rounded-lg transition duration-200 shadow-lg transform hover:scale-105 font-semibold">
                        Sign In
                    </a>
                @endauth
            </div>

            <!-- Hamburger Button -->
            <div class="md:hidden">
                <button id="hamburger-btn" class="flex flex-col space-y-1.5 w-8 h-8 justify-center items-center">
                    <span class="hamburger-line w-6 h-0.5 bg-white rounded"></span>
                    <span class="hamburger-line w-6 h-0.5 bg-white rounded"></span>
                    <span class="hamburger-line w-6 h-0.5 bg-white rounded"></span>
                </button>
            </div>
        </div>
    </nav>
</header>
