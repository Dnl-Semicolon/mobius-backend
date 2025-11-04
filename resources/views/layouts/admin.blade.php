<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Mobius Admin</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50">
<div class="flex">
    <aside class="w-64 bg-white border-r min-h-screen">
        <div class="p-4 font-bold">Mobius Admin</div>
        <nav class="px-2 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Dashboard</a>
            <a href="{{ route('admin.stores.index') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Stores</a>
            {{-- Add Bins, Users, Rules later --}}
        </nav>
    </aside>
    <main class="flex-1">
        <header class="flex items-center justify-between px-6 py-4 border-b bg-white">
            <h1 class="text-lg font-semibold">@yield('title','Admin')</h1>
            <div class="text-sm">Role: SuperAdmin</div>
        </header>
        <section class="p-6">@yield('content')</section>
    </main>
</div>
</body>
</html>
