<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SIAC</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body::before {
            content: '';
            position: fixed;
            top: 0; left: 0;
            width: 100vw;
            height: 100vh;
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset('img/fondo-chicama.png') }}');
            background-size: cover;
            background-position: center;
            z-index: -1;
        }
    </style>
</head>
<body class="text-white relative font-['figtree']">
    @if (Route::has('login'))
        <livewire:welcome.navigation />
    @endif
    <div class="min-h-screen flex flex-col items-center justify-center text-center px-4">
        <div class="animate-fade-in">
            <img src="{{ asset('img/logoGrande.png') }}" alt="SIAC Chicama" class="w-96 md:w-[600px] mb-6">
        </div>
        <p class="text-sm md:text-base text-gray-200 max-w-xl animate-fade-in-up delay-300">
            Sistema Integrado de Administración Civil del distrito de Chicama.
        </p>
        <div class="mt-10 text-xs text-gray-400">
            Municipalidad Distrital de Chicama © {{ date('Y') }}
        </div>
    </div>
</body>
</html>
