<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Mobius Admin</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/htmx.org@2.0.7/dist/htmx.min.js"
        integrity="sha384-ZBXiYtYQ6hJ2Y0ZNoYuI+Nq5MqWBr+chMrS/RkXpNzQCApHEhOt2aY8EJgqwHLkJ"
        crossorigin="anonymous"></script>
</head>

<body class="min-h-screen bg-gray-50">
    <div class="flex">
        <aside class="w-64 bg-white border-r min-h-screen">
            <div class="p-4 border-b">
                <h1 class="font-bold text-xl text-blue-600">Mobius Admin</h1>
                <p class="text-xs text-gray-500 mt-1">Smart Recycling Platform</p>
            </div>
            <nav class="px-2 py-4 space-y-1">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.stores.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('admin.stores.*') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                        </path>
                    </svg>
                    Stores
                </a>
                <a href="{{ route('admin.bins.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('admin.bins.*') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                        </path>
                    </svg>
                    Bins
                </a>
                <a href="{{ route('admin.activity.index') }}"
                    class="flex items-center gap-3 px-3 py-2 rounded {{ request()->routeIs('admin.activity.*') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-700 hover:bg-gray-100' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    Activity
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2 rounded text-gray-400 cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                        </path>
                    </svg>
                    Users <span class="ml-auto text-xs bg-gray-200 px-2 py-0.5 rounded">Soon</span>
                </a>
                <a href="#" class="flex items-center gap-3 px-3 py-2 rounded text-gray-400 cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    Reports <span class="ml-auto text-xs bg-gray-200 px-2 py-0.5 rounded">Soon</span>
                </a>
            </nav>
        </aside>
        <main class="flex-1">
            <header class="flex items-center justify-between px-6 py-4 border-b bg-white">
                <h1 class="text-lg font-semibold">@yield('title', 'Admin')</h1>

                <!-- User Dropdown -->
                <div class="flex items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </header>
            <section class="p-6">
                @if(session('success'))
                    <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="font-medium text-green-800">Success!</p>
                            <p class="text-sm text-green-700">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded flex items-start gap-3">
                        <svg class="w-5 h-5 text-red-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="font-medium text-red-800">Error!</p>
                            <p class="text-sm text-red-700">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded">
                        <div class="flex items-start gap-3">
                            <svg class="w-5 h-5 text-red-600 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div class="flex-1">
                                <p class="font-medium text-red-800">Validation Errors</p>
                                <ul class="mt-2 text-sm text-red-700 list-disc list-inside space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                @yield('content')
            </section>
        </main>
    </div>
</body>

</html>