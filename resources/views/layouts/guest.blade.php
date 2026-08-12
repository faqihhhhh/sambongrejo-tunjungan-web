<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Login Admin Desa') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-blora-cream text-blora-text">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
            <!-- Background Decoration -->
            <div class="absolute top-0 left-0 w-full h-[45%] bg-blora-green -z-10 rounded-b-[40px] shadow-lg"></div>

            <div class="z-10 flex flex-col items-center mb-6 mt-10 sm:mt-0">
                <a href="/" class="flex flex-col items-center gap-3 group">
                    <img src="{{ asset('images/logo-desa.png') }}" alt="Logo Desa" class="w-20 h-20 sm:w-24 sm:h-24 object-contain drop-shadow-md group-hover:scale-105 transition-transform duration-300">
                    <div class="text-center">
                        <h1 class="text-white font-serif text-2xl sm:text-3xl font-bold drop-shadow-md">Desa Sambongrejo</h1>
                        <p class="text-green-100 text-sm font-medium mt-1 tracking-wide">Login Admin Panel</p>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-8 py-8 bg-white shadow-2xl overflow-hidden sm:rounded-2xl border-t-4 border-blora-gold z-10 mx-4">
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-center text-sm text-gray-500 z-10">
                &copy; {{ date('Y') }} Pemerintah Desa Sambongrejo
            </div>
        </div>
    </body>
</html>
