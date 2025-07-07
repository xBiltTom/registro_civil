<div class="h-full overflow-auto bg-gray-900 text-white min-h-screen">
    <section class="py-10 sm:py-16 lg:py-6">
        <div class="max-w-5xl px-4 mx-auto sm:px-6 lg:px-8">
            <div class="max-w-xl mx-auto text-center">
                <h2 class="text-3xl font-bold text-white sm:text-4xl sm:leading-tight">Tu Actividad en el Sistema</h2>
            </div>

            <div class="grid grid-cols-1 gap-6 mt-10 sm:grid-cols-2 md:gap-8">
                <!-- Actas relacionadas - Azul -->
                <div class="bg-gray-800 border-l-8 border-blue-500 rounded-lg shadow">
                    <div class="px-7 py-9">
                        <div class="flex items-center">
                            <a href="{{ route('personal') }}">
                                <svg class="w-16 h-16 text-blue-500 hover:scale-110 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-scroll-text-icon lucide-scroll-text">
                                    <path d="M15 12h-5"/><path d="M15 8h-5"/><path d="M19 17V5a2 2 0 0 0-2-2H4"/><path d="M8 21h12a2 2 0 0 0 2-2v-1a1 1 0 0 0-1-1H11a1 1 0 0 0-1 1v1a2 2 0 1 1-4 0V5a2 2 0 1 0-4 0v2a1 1 0 0 0 1 1h3"/>
                                </svg>
                            </a>
                            <h3 class="ml-4 text-6xl font-bold text-white">{{ $cantidadActas }}</h3>
                        </div>
                        <p class="mt-4 text-sm text-blue-300">Actas relacionadas contigo</p>
                    </div>
                </div>

                <!-- Solicitudes realizadas - Verde -->
                <div class="bg-gray-800 border-l-8 border-green-500 rounded-lg shadow">
                    <div class="px-7 py-9">
                        <div class="flex items-center">
                            <a href="{{ route('solicitudes.personal') }}">
                                <svg class="w-16 h-16 text-green-500 hover:scale-110 transition-transform duration-200" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-inbox-icon lucide-inbox">
                                    <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"/>
                                    <path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"/>
                                </svg>
                            </a>
                            <h3 class="ml-4 text-6xl font-bold text-white">{{ $cantidadSolicitudes }}</h3>
                        </div>
                        <p class="mt-4 text-sm text-green-300">Tus solicitudes registradas</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
