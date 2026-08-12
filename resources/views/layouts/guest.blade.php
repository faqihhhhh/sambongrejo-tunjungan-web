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

            <div class="z-10 flex flex-col items-center mb-6 mt-10 sm:mt-0">
                <a href="/" class="flex flex-col items-center gap-3 group">
                    <!-- Menggunakan logo blora.png sesuai permintaan -->
                    <img src="{{ asset('images/logo-blora.png') }}" alt="Logo Kab Blora" class="w-20 h-20 sm:w-24 sm:h-24 object-contain drop-shadow-sm group-hover:scale-105 transition-transform duration-300">
                    <div class="text-center">
                        <h1 class="text-blora-green-dark font-serif text-2xl sm:text-3xl font-bold">Desa Sambongrejo</h1>
                        <p class="text-gray-500 text-sm font-medium mt-1 tracking-wide">Login Admin Panel</p>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-8 py-8 bg-white shadow-xl overflow-hidden sm:rounded-2xl border-t-4 border-blora-gold z-10 mx-4">
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-center text-sm text-gray-500 z-10">
                &copy; {{ date('Y') }} Pemerintah Desa Sambongrejo
            </div>
        </div>
    </body>
</html>
