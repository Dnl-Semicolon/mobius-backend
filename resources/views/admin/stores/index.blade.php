@extends('layouts.admin')
@section('title','Stores')
@section('content')
    <div class="flex justify-between mb-4">
        <form method="get" class="flex gap-2">
            <input name="q" value="{{ request('q') }}" placeholder="Search…" class="border rounded px-3 py-2">
            <button class="px-3 py-2 bg-gray-800 text-white rounded">Search</button>
        </form>
        <a href="{{ route('admin.stores.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded">New Store</a>
    </div>

    <div class="bg-white border rounded">
        <table class="w-full text-left">
            <thead class="bg-gray-50">
            <tr><th class="p-3">Brand</th><th class="p-3">Store</th><th class="p-3">City</th><th class="p-3">Status</th><th class="p-3"></th></tr>
            </thead>
            <tbody>
            @foreach($stores as $s)
                <tr class="border-t">
                    <td class="p-3">{{ $s->brand_name }}</td>
                    <td class="p-3">{{ $s->store_name }}</td>
                    <td class="p-3">{{ $s->city }}</td>
                    <td class="p-3">
              <span class="px-2 py-1 rounded text-xs {{ $s->status==='active'?'bg-green-100 text-green-700':'bg-gray-100 text-gray-600' }}">
                {{ ucfirst($s->status) }}
              </span>
                    </td>
                    <td class="p-3 text-right">
                        <a class="text-blue-600 mr-3" href="{{ route('admin.stores.edit',$s) }}">Edit</a>
                        <form action="{{ route('admin.stores.destroy',$s) }}" method="post" class="inline"
                              onsubmit="return confirm('Delete this store?')">
                            @csrf @method('DELETE')
                            <button class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $stores->links() }}</div>
@endsection
