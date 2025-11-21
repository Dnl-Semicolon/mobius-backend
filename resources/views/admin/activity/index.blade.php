@extends('layouts.admin')
@section('title','Activity')
@section('content')
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-900">{{ $operationsName }}</h2>
        <p class="text-gray-600">Live view of claimed recycling activity across the network.</p>
    </div>

    <div class="grid gap-6 lg:grid-cols-4 mb-8">
        <div class="rounded border-l-4 border-blue-600 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-gray-500">Total Points</p>
            <p class="text-3xl font-semibold text-gray-900">{{ number_format($summary['total_points']) }}</p>
        </div>
        <div class="rounded border-l-4 border-emerald-600 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-gray-500">Claimed Cups</p>
            <p class="text-3xl font-semibold text-gray-900">{{ number_format($summary['total_cups']) }}</p>
        </div>
        <div class="rounded border-l-4 border-purple-600 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-gray-500">Active Brands</p>
            <p class="text-3xl font-semibold text-gray-900">{{ count($summary['by_brand']) }}</p>
        </div>
        <div class="rounded border-l-4 border-orange-500 bg-white p-5 shadow-sm">
            <p class="text-sm font-medium text-gray-500">Recent Events</p>
            <p class="text-3xl font-semibold text-gray-900">{{ count($summary['recent_events']) }}</p>
        </div>
    </div>

    <div class="grid gap-6 lg:grid-cols-2 mb-8">
        <div class="rounded bg-white p-5 shadow">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Recent Activity</h3>
                <span class="text-xs uppercase tracking-wide text-gray-500">Last {{ count($summary['recent_events']) }} events</span>
            </div>
            <ul class="divide-y divide-gray-200">
                @forelse ($summary['recent_events'] as $event)
                    @php
                        $recentAt = $event['created_at'] ? \Carbon\Carbon::parse($event['created_at']) : null;
                    @endphp
                    <li class="py-3 flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $event['brand'] }}</p>
                            <p class="text-xs text-gray-500">{{ $event['material'] ?? 'Unknown material' }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold text-gray-800">+{{ $event['points_awarded'] }} pts</p>
                            <p class="text-xs text-gray-500">{{ $recentAt ? $recentAt->diffForHumans() : '—' }}</p>
                        </div>
                    </li>
                @empty
                    <li class="py-6 text-center text-sm text-gray-500">No claimed events yet.</li>
                @endforelse
            </ul>
        </div>
        <div class="rounded bg-white p-5 shadow">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Brand Breakdown</h3>
            <ul class="space-y-3">
                @forelse($summary['by_brand'] as $brand => $count)
                    <li class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="inline-flex h-2.5 w-2.5 rounded-full bg-blue-500"></span>
                            <span class="text-sm font-medium text-gray-800">{{ $brand }}</span>
                        </div>
                        <span class="text-sm text-gray-600">{{ $count }} cups</span>
                    </li>
                @empty
                    <li class="text-sm text-gray-500">No brand data yet.</li>
                @endforelse
            </ul>
        </div>
    </div>

    @include('admin.activity.partials.history')
@endsection
