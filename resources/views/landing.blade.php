<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mobius - Smart Recycling Ecosystem</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="antialiased bg-slate-900 text-slate-50 font-sans selection:bg-emerald-500 selection:text-white">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-slate-900/80 backdrop-blur-md border-b border-slate-800" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex-shrink-0 flex items-center gap-2">
                    <!-- Logo placeholder -->
                    <div
                        class="w-8 h-8 bg-gradient-to-br from-emerald-400 to-cyan-500 rounded-lg flex items-center justify-center text-slate-900 font-bold text-xl">
                        M</div>
                    <span class="font-bold text-xl tracking-tight">Mobius</span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features"
                        class="text-sm font-medium text-slate-300 hover:text-emerald-400 transition-colors">Features</a>
                    <a href="#how-it-works"
                        class="text-sm font-medium text-slate-300 hover:text-emerald-400 transition-colors">How it
                        Works</a>
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center px-5 py-2 border border-transparent text-sm font-medium rounded-full text-slate-900 bg-emerald-400 hover:bg-emerald-500 transition-all shadow-[0_0_20px_rgba(52,211,153,0.3)] hover:shadow-[0_0_30px_rgba(52,211,153,0.5)]">
                        Admin Login
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button @click="open = !open" class="text-slate-300 hover:text-white focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path x-show="!open" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path x-show="open" x-cloak stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" x-cloak class="md:hidden bg-slate-800 border-b border-slate-700">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                <a href="#features"
                    class="block px-3 py-2 rounded-md text-base font-medium text-slate-300 hover:text-white hover:bg-slate-700">Features</a>
                <a href="#how-it-works"
                    class="block px-3 py-2 rounded-md text-base font-medium text-slate-300 hover:text-white hover:bg-slate-700">How
                    it Works</a>
                <a href="{{ route('login') }}"
                    class="block w-full text-center px-5 py-3 mt-4 rounded-lg font-bold text-slate-900 bg-emerald-400 hover:bg-emerald-500">
                    Admin Login
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full z-0 pointer-events-none">
            <div class="absolute top-20 left-10 w-72 h-72 bg-emerald-500/20 rounded-full blur-[100px]"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-cyan-500/20 rounded-full blur-[100px]"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div
                class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-slate-800/50 border border-slate-700 mb-8 backdrop-blur-sm">
                <span class="flex h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                <span class="text-xs font-medium text-emerald-400 tracking-wide uppercase">AI-Powered Recycling</span>
            </div>

            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight text-white mb-6 leading-tight">
                Recycling Made <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-400 to-cyan-400">Smart</span> &
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">Rewarding</span>
            </h1>

            <p class="mt-4 max-w-2xl mx-auto text-xl text-slate-400 mb-10">
                Mobius uses advanced AI vision to sort waste automatically, while gamifying the experience to reward
                users for saving the planet.
            </p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('login') }}"
                    class="px-8 py-4 rounded-full bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-bold text-lg shadow-lg shadow-emerald-500/25 hover:shadow-emerald-500/40 hover:-translate-y-1 transition-all duration-300">
                    Get Started
                </a>
                <a href="#how-it-works"
                    class="px-8 py-4 rounded-full bg-slate-800 text-white font-semibold text-lg border border-slate-700 hover:bg-slate-700 transition-all duration-300">
                    Learn More
                </a>
            </div>

            <!-- Hero Image / Dashboard Preview Placeholder -->
            <div
                class="mt-16 relative mx-auto max-w-5xl rounded-2xl border border-slate-800 bg-slate-900/50 backdrop-blur-xl p-2 shadow-2xl">
                <div
                    class="rounded-xl overflow-hidden bg-slate-800 aspect-[16/9] flex items-center justify-center relative group">
                    <div
                        class="absolute inset-0 bg-gradient-to-tr from-emerald-500/10 to-cyan-500/10 opacity-50 group-hover:opacity-75 transition-opacity">
                    </div>
                    <!-- Abstract representation of the dashboard -->
                    <div class="text-center p-8">
                        <div class="w-20 h-20 mx-auto bg-slate-700 rounded-2xl mb-4 flex items-center justify-center">
                            <svg class="w-10 h-10 text-emerald-400" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white">Real-time Analytics Dashboard</h3>
                        <p class="text-slate-400 mt-2">Track recycling metrics, bin status, and environmental impact.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Grid -->
    <section id="features" class="py-24 bg-slate-900 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">Why Mobius?</h2>
                <p class="text-slate-400 max-w-2xl mx-auto">We combine cutting-edge technology with behavioral
                    psychology to solve the recycling crisis.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div
                    class="p-8 rounded-2xl bg-slate-800/50 border border-slate-700 hover:border-emerald-500/50 transition-colors group">
                    <div
                        class="w-12 h-12 bg-emerald-500/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-emerald-500/20 transition-colors">
                        <svg class="w-6 h-6 text-emerald-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">AI Vision Sorting</h3>
                    <p class="text-slate-400 leading-relaxed">
                        Our smart bins use OpenAI Vision to automatically detect and sort cups, lids, and straws,
                        ensuring pure recycling streams.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div
                    class="p-8 rounded-2xl bg-slate-800/50 border border-slate-700 hover:border-cyan-500/50 transition-colors group">
                    <div
                        class="w-12 h-12 bg-cyan-500/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-cyan-500/20 transition-colors">
                        <svg class="w-6 h-6 text-cyan-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Gamified Rewards</h3>
                    <p class="text-slate-400 leading-relaxed">
                        Users earn points for every item recycled. Scan a QR code to claim rewards and track your
                        personal environmental impact.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div
                    class="p-8 rounded-2xl bg-slate-800/50 border border-slate-700 hover:border-blue-500/50 transition-colors group">
                    <div
                        class="w-12 h-12 bg-blue-500/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-blue-500/20 transition-colors">
                        <svg class="w-6 h-6 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-3">Admin Insights</h3>
                    <p class="text-slate-400 leading-relaxed">
                        Store owners get a powerful dashboard to monitor fill levels, material breakdown, and estimated
                        recyclable value in real-time.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- How it Works -->
    <section id="how-it-works" class="py-24 bg-slate-900 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Simple Steps to a Greener Future</h2>
                    <div class="space-y-8">
                        <div class="flex gap-4">
                            <div
                                class="flex-shrink-0 w-10 h-10 rounded-full bg-emerald-500/10 text-emerald-400 font-bold flex items-center justify-center border border-emerald-500/20">
                                1</div>
                            <div>
                                <h4 class="text-lg font-semibold text-white mb-2">Drop your cup</h4>
                                <p class="text-slate-400">Place your used beverage cup into the Mobius smart bin.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div
                                class="flex-shrink-0 w-10 h-10 rounded-full bg-emerald-500/10 text-emerald-400 font-bold flex items-center justify-center border border-emerald-500/20">
                                2</div>
                            <div>
                                <h4 class="text-lg font-semibold text-white mb-2">AI Analysis</h4>
                                <p class="text-slate-400">Our system instantly identifies the material and brand,
                                    sorting it into the correct internal compartment.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div
                                class="flex-shrink-0 w-10 h-10 rounded-full bg-emerald-500/10 text-emerald-400 font-bold flex items-center justify-center border border-emerald-500/20">
                                3</div>
                            <div>
                                <h4 class="text-lg font-semibold text-white mb-2">Earn Rewards</h4>
                                <p class="text-slate-400">Scan the QR code displayed on the bin to collect points and
                                    redeem them for discounts.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-emerald-500/20 to-cyan-500/20 blur-3xl rounded-full">
                    </div>
                    <div class="relative bg-slate-800 border border-slate-700 rounded-2xl p-8 shadow-2xl">
                        <!-- Abstract UI representation of the bin screen -->
                        <div
                            class="aspect-[3/4] bg-slate-900 rounded-xl border border-slate-700 p-6 flex flex-col items-center justify-center text-center">
                            <div
                                class="w-24 h-24 bg-emerald-500/20 rounded-full flex items-center justify-center mb-6 animate-pulse">
                                <svg class="w-12 h-12 text-emerald-400" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-2">Recycling Successful!</h3>
                            <p class="text-slate-400 mb-8">+10 Points Earned</p>
                            <div class="w-48 h-48 bg-white p-2 rounded-lg">
                                <div
                                    class="w-full h-full bg-slate-200 flex items-center justify-center text-slate-400 text-xs">
                                    QR Code Placeholder
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-950 border-t border-slate-800 py-12">
        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-2">
                <div
                    class="w-6 h-6 bg-gradient-to-br from-emerald-400 to-cyan-500 rounded-md flex items-center justify-center text-slate-900 font-bold text-xs">
                    M</div>
                <span class="font-bold text-lg text-white">Mobius</span>
            </div>
            <div class="text-slate-500 text-sm">
                &copy; {{ date('Y') }} Mobius Ecosystem. All rights reserved.
            </div>
            <div class="flex gap-6">
                <a href="#" class="text-slate-500 hover:text-emerald-400 transition-colors">Privacy</a>
                <a href="#" class="text-slate-500 hover:text-emerald-400 transition-colors">Terms</a>
                <a href="{{ route('login') }}" class="text-slate-500 hover:text-emerald-400 transition-colors">Admin</a>
            </div>
        </div>
    </footer>

</body>

</html>