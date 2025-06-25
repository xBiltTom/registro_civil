<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SIAC') }}</title>

        <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles

    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-700">


            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($sidebar))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $sidebar }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="">
                {{ $slot }}

            </main>
        </div>

        <script>
            document.addEventListener('livewire:navigated', () => {
                if (window.initFlowbite) {
                    window.initFlowbite(); // si lo usas así
                } else {
                    // Forzamos al menos que todos los dropdowns y tooltips se vuelvan a inicializar
                    import('https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js')
                        .then((module) => {
                            console.log('Flowbite reinicializado');
                        });

                }
            });
        </script>
        @livewireScripts
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html>
