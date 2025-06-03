<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} | Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-800 h-screen w-screen flex items-center justify-between relative overflow-hidden px-4">
    
    <!-- Contenedor blanco del escudo (izquierda) -->
    <div class="hidden md:flex absolute left-0 top-0 h-full w-2/5 bg-white z-0 items-center justify-center">
        <img src="/img/CHICAMA.png" alt="Escudo Chicama"
            class="w-[120px] md:w-[160px] lg:w-[180px] h-auto opacity-90 drop-shadow-lg">
    </div>

    <!-- Bolas decorativas (derecha) -->
    <div class="w-[200px] h-[200px] bg-blue-600 rounded-full absolute top-[5%] left-[60%] md:left-[10%] lg:left-[65%] z-0 blur-2xl opacity-60"></div>
    <div class="w-[250px] h-[250px] bg-emerald-500 rounded-full absolute top-[65%] left-[12%] lg:left-[65%] z-0 blur-2xl opacity-60 animate-bounce"></div>
    <div class="w-[200px] h-[200px] bg-blue-400 rounded-full absolute top-[5%] left-[50%] md:left-[5%] lg:left-[85%] z-0 blur-2xl opacity-60"></div>

    <main class="z-10 w-full flex justify-end md:pr-10">
        <div class="w-full max-w-md px-6">
            {{ $slot }}
        </div>
    </main>

    @livewireScripts
</body>
</html>
