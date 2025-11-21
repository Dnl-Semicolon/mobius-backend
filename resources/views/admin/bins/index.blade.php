@extends('layouts.admin')
@section('title','Bins')
@section('content')
    <div class="flex flex-col gap-4 mb-6 lg:flex-row lg:items-center lg:justify-between">
        <form method="get" class="flex flex-wrap gap-3">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search bins…" class="w-64 rounded border px-3 py-2">
            <select name="status" class="rounded border px-3 py-2">
                <option value="">All statuses</option>
                <option value="active" @selected(request('status')==='active')>Active</option>
                <option value="inactive" @selected(request('status')==='inactive')>Inactive</option>
            </select>
            <button class="rounded bg-gray-900 px-4 py-2 text-white">Filter</button>
        </form>
        <a href="{{ route('admin.bins.create') }}" class="inline-flex items-center rounded bg-blue-600 px-4 py-2 text-white shadow-sm hover:bg-blue-500">
            New Bin
        </a>
    </div>

    <div class="overflow-hidden rounded border bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
                <tr>
                    <th class="px-4 py-3">Bin</th>
                    <th class="px-4 py-3">Store</th>
                    <th class="px-4 py-3">Hardware ID</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Last Seen</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
            @forelse($bins as $bin)
                <tr class="border-t">
                    <td class="px-4 py-3">
                        <div class="font-semibold text-gray-900">{{ $bin->name }}</div>
                        <p class="text-xs text-gray-500">{{ $bin->location_name ?? 'No location set' }}</p>
                    </td>
                    <td class="px-4 py-3">
                        <div class="text-sm font-medium text-gray-900">{{ $bin->store?->store_name }}</div>
                        <p class="text-xs text-gray-500">{{ $bin->store?->brand_name }}</p>
                    </td>
                    <td class="px-4 py-3 font-mono text-xs text-gray-700">{{ $bin->hardware_identifier }}</td>
                    <td class="px-4 py-3">
                        <span class="rounded px-2 py-1 text-xs font-semibold {{ $bin->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-200 text-gray-700' }}">
                            {{ ucfirst($bin->status) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-600">
                        {{ optional($bin->last_seen_at)->diffForHumans() ?? '—' }}
                    </td>
                    <td class="px-4 py-3 text-right text-sm">
                        <a href="{{ route('admin.bins.edit', $bin) }}" class="text-blue-600 hover:underline mr-3">Edit</a>
                        <form action="{{ route('admin.bins.destroy', $bin) }}" method="post" class="inline" onsubmit="return confirm('Delete this bin?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-sm text-gray-500">No bins yet. Create one to link hardware to a store.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $bins->links() }}</div>
@endsection
