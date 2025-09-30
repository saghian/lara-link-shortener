<div id="mobile-menu" class="mobile-menu fixed inset-0 bg-black/90 z-50 md:hidden">
    <div class="flex justify-end p-4">
        <button id="close-menu" class="text-white p-2">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <div class="flex flex-col items-center justify-center h-full space-y-8">
        @auth
            @include('layouts.partials.mobile-user-menu')
        @else
            @include('layouts.partials.mobile-guest-menu')
        @endauth
    </div>
</div>
