<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} | Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-screen w-screen relative overflow-hidden px-4">
    <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('/img/fondo-chicama.png');"></div>

    <div class="absolute inset-0 bg-black/70 z-0"></div>

    <main class="relative z-10 flex items-center justify-center w-full h-full">
        <div class="w-full max-w-md px-6">
            {{ $slot }}
        </div>
    </main>

    @livewireScripts
</body>

</html>
