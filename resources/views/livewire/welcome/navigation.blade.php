<nav class="flex flex-1 justify-center h-full content-center">
    @auth
        <a
            href="{{ url('/dashboard') }}"
            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
        >
            Principal
        </a>
    @else
        <a
            href="{{ route('login') }}" wire:navigate
            class="absolute top-6 right-6 inline-flex items-center gap-2 rounded-full bg-white/90 px-5 py-2 text-black font-semibold shadow-lg ring-1 ring-white/30 backdrop-blur-md transition-all duration-300 hover:bg-white hover:text-gray-800 dark:bg-white/10 dark:text-white dark:hover:bg-white/20 dark:ring-white/20"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H3m0 0l4-4m-4 4l4 4m13-9v10a2 2 0 01-2 2H7a2 2 0 01-2-2v-1" />
            </svg>
            Log in
        </a>

        {{-- @if (Route::has('register'))
            <a
                href="{{ route('register') }}"
                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
            >
                Register
            </a>
        @endif --}}
    @endauth
</nav>
