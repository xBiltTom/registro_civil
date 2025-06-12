<!-- filepath: /c:/Users/Usuario/Desktop/Laravel/Project_Git/registro-civil/resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SIAC</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-black">
        @if (Route::has('login'))
                <livewire:welcome.navigation />
            @endif
        <div class="">
            <div class="h-screen flex items-center justify-center">
                <img src="{{asset('img/logoGrande.png')}}" alt="" width="600px" srcset="">
            </div>

        </div>

    </body>
</html>
