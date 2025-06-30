<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }} | Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-screen w-screen flex items-center justify-center relative overflow-hidden px-4 bg-cover bg-center" style="background-image: url('/img/otroFondo.jpg');">

    {{-- <div class="w-[250px] h-[250px] bg-emerald-500 rounded-full absolute top-[65%] left-[12%] lg:left-[55%] z-0 blur-2xl opacity-60 animate-bounce"></div> --}}

    <main class="z-10 w-full flex justify-center">
        <div class="w-full max-w-md px-6">
            {{ $slot }}
        </div>
    </main>

    @livewireScripts
</body>
</html>
