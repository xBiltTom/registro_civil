<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} | Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-800 h-screen w-screen flex items-center justify-center relative overflow-visible">


    <!-- Bolas decorativas -->
    <div class="w-[280px] h-[280px] bg-blue-600 rounded-full absolute top-[5%] left-[60%] -translate-x-1/2 z-0 blur-2xl opacity-60"></div>



    <div class="w-[280px] h-[280px] bg-emerald-500 rounded-full absolute top-[60%] left-[12%] lg:left-[30%] z-0 blur-2xl opacity-60 animate-bounce"></div>
    <div class="w-[300px] h-[300px] bg-blue-400 rounded-full absolute top-[5%] left-[5%] md:left-[23%] lg:left-[30%] z-0 blur-2xl opacity-60"></div>

    <!-- Contenido dinámico (formulario login, etc.) -->
    <main class="z-10 w-full max-w-md px-6">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
