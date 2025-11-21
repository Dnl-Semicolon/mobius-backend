<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mobius') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-slate-100 antialiased bg-slate-900 selection:bg-emerald-500 selection:text-white">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">

        <!-- Background Elements -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full z-0 pointer-events-none">
            <div
                class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-emerald-500/20 rounded-full blur-[100px]">
            </div>
            <div
                class="absolute bottom-[-10%] right-[-10%] w-[500px] h-[500px] bg-cyan-500/20 rounded-full blur-[100px]">
            </div>
        </div>

        <div class="relative z-10 flex flex-col items-center">
            <a href="/" class="mb-8 transition-transform hover:scale-105">
                <img src="{{ asset('assets/mobius-website-logo.png') }}" alt="Mobius Logo"
                    class="w-24 h-24 object-contain drop-shadow-[0_0_15px_rgba(52,211,153,0.5)]">
            </a>
            <h2 class="text-3xl font-bold text-white mb-2">Welcome Back</h2>
            <p class="text-slate-400 mb-8 text-center max-w-sm">Sign in to manage your smart recycling ecosystem</p>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-8 py-8 bg-slate-800/50 backdrop-blur-xl border border-slate-700 shadow-2xl overflow-hidden sm:rounded-2xl relative z-10">
            {{ $slot }}
        </div>

        <div class="mt-8 text-slate-500 text-sm relative z-10">
            &copy; {{ date('Y') }} Mobius Ecosystem.
        </div>
    </div>
</body>

</html>