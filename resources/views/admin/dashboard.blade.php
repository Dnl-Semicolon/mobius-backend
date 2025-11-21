@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')

<!-- Welcome Section -->
<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Welcome to Mobius Admin</h2>
    <p class="text-gray-600">Smart Recycling Bin Management Platform</p>
</div>

<!-- Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Stores Card -->
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 font-medium">Total Stores</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_stores'] }}</p>
            </div>
            <div class="bg-blue-100 rounded-full p-3">
                <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
        </div>
        <div class="mt-3 flex items-center text-sm">
            <span class="text-green-600 font-medium">{{ $stats['active_stores'] }} active</span>
            <span class="text-gray-400 mx-2">•</span>
            <span class="text-gray-500">{{ $stats['inactive_stores'] }} inactive</span>
        </div>
    </div>

    <!-- Total Bins Card -->
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 font-medium">Recycling Bins</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['total_bins'] }}</p>
            </div>
            <div class="bg-green-100 rounded-full p-3">
                <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
            </div>
        </div>
        <div class="mt-3 text-sm text-gray-500">
            Deployed across all stores
        </div>
    </div>

    <!-- Today's Recycling Card -->
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 font-medium">Recycling Today</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['recycling_today'] }}</p>
            </div>
            <div class="bg-purple-100 rounded-full p-3">
                <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
            </div>
        </div>
        <div class="mt-3 text-sm text-gray-500">
            Transactions processed
        </div>
    </div>

    <!-- Monthly Recycling Card -->
    <div class="bg-white rounded-lg shadow p-6 border-l-4 border-orange-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-600 font-medium">This Month</p>
                <p class="text-3xl font-bold text-gray-800">{{ $stats['recycling_this_month'] }}</p>
            </div>
            <div class="bg-orange-100 rounded-full p-3">
                <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
        </div>
        <div class="mt-3 text-sm text-gray-500">
            Total transactions
        </div>
    </div>
</div>

<!-- Two Column Layout -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Recent Stores - Takes 2 columns -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-800">Recent Stores</h3>
                <a href="{{ route('admin.stores.index') }}" class="text-sm text-blue-600 hover:text-blue-800">View all</a>
            </div>
            <div class="p-6">
                @if($recent_stores->count() > 0)
                    <div class="space-y-4">
                        @foreach($recent_stores as $store)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                                            {{ substr($store->store_name, 0, 1) }}
                                        </div>
                                        <div>
                                            <h4 class="font-semibold text-gray-800">{{ $store->store_name }}</h4>
                                            <p class="text-sm text-gray-600">{{ $store->brand_name }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right mr-4">
                                    <p class="text-sm text-gray-600">{{ $store->city }}, {{ $store->state }}</p>
                                    <p class="text-xs text-gray-500">{{ $store->created_at->diffForHumans() }}</p>
                                </div>
                                <div>
                                    <span class="px-3 py-1 rounded-full text-xs font-medium {{ $store->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($store->status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        <p class="mt-2 text-sm text-gray-600">No stores added yet</p>
                        <a href="{{ route('admin.stores.create') }}" class="mt-3 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Add First Store
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions Sidebar -->
    <div class="lg:col-span-1">
        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">Quick Actions</h3>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('admin.stores.create') }}" class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg hover:bg-blue-100 transition group">
                    <div class="bg-blue-500 rounded-lg p-2 group-hover:bg-blue-600 transition">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </div>
                    <span class="font-medium text-gray-700">Add New Store</span>
                </a>

                <a href="{{ route('admin.stores.index') }}" class="flex items-center gap-3 p-3 bg-green-50 rounded-lg hover:bg-green-100 transition group">
                    <div class="bg-green-500 rounded-lg p-2 group-hover:bg-green-600 transition">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <span class="font-medium text-gray-700">Manage Stores</span>
                </a>

                <button class="w-full flex items-center gap-3 p-3 bg-purple-50 rounded-lg hover:bg-purple-100 transition group opacity-50 cursor-not-allowed" disabled>
                    <div class="bg-purple-500 rounded-lg p-2">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <span class="font-medium text-gray-700">Add Recycling Bin</span>
                </button>

                <button class="w-full flex items-center gap-3 p-3 bg-orange-50 rounded-lg hover:bg-orange-100 transition group opacity-50 cursor-not-allowed" disabled>
                    <div class="bg-orange-500 rounded-lg p-2">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <span class="font-medium text-gray-700">View Reports</span>
                </button>
            </div>
        </div>

        <!-- System Status -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">System Status</h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">API Status</span>
                    <span class="flex items-center text-green-600 text-sm font-medium">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                        Operational
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Database</span>
                    <span class="flex items-center text-green-600 text-sm font-medium">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                        Connected
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Google Maps</span>
                    <span class="flex items-center text-green-600 text-sm font-medium">
                        <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                        Active
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">Last Updated</span>
                    <span class="text-sm text-gray-600">Just now</span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
