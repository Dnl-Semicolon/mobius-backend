<div class="grid gap-6 lg:grid-cols-2">
    <div class="rounded border bg-white p-5 shadow-sm">
        <h2 class="mb-4 text-lg font-semibold text-gray-800">General</h2>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Store</label>
                <select name="store_id" class="mt-1 w-full rounded border px-3 py-2">
                    <option value="">Select store…</option>
                    @foreach($stores as $store)
                        <option value="{{ $store->id }}" @selected(old('store_id', $bin->store_id) === $store->id)>
                            {{ $store->brand_name }} – {{ $store->store_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Display name</label>
                <input type="text" name="name" value="{{ old('name', $bin->name) }}" class="mt-1 w-full rounded border px-3 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Hardware identifier</label>
                <input type="text" name="hardware_identifier" value="{{ old('hardware_identifier', $bin->hardware_identifier) }}" class="mt-1 w-full rounded border px-3 py-2 font-mono text-sm">
                <p class="mt-1 text-xs text-gray-500">Matches the ID configured on the physical bin firmware.</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <select name="status" class="mt-1 w-full rounded border px-3 py-2">
                    <option value="active" @selected(old('status', $bin->status) === 'active')>Active</option>
                    <option value="inactive" @selected(old('status', $bin->status) === 'inactive')>Inactive</option>
                </select>
            </div>
        </div>
    </div>

    <div class="rounded border bg-white p-5 shadow-sm">
        <h2 class="mb-4 text-lg font-semibold text-gray-800">Location</h2>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Location tag</label>
                <input type="text" name="location_name" value="{{ old('location_name', $bin->location_name) }}" class="mt-1 w-full rounded border px-3 py-2" placeholder="Lobby, Drive Thru, etc.">
            </div>
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Latitude</label>
                    <input type="text" name="lat" value="{{ old('lat', $bin->lat) }}" class="mt-1 w-full rounded border px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Longitude</label>
                    <input type="text" name="lng" value="{{ old('lng', $bin->lng) }}" class="mt-1 w-full rounded border px-3 py-2">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Notes</label>
                <textarea name="notes" rows="4" class="mt-1 w-full rounded border px-3 py-2">{{ old('notes', $bin->notes) }}</textarea>
            </div>
        </div>
    </div>
</div>

<div class="mt-6 flex justify-end gap-3">
    <a href="{{ route('admin.bins.index') }}" class="rounded border border-gray-300 px-4 py-2 text-sm text-gray-700">Cancel</a>
    <button class="rounded bg-blue-600 px-5 py-2 text-sm font-semibold text-white shadow hover:bg-blue-500">
        {{ $submitLabel ?? 'Save' }}
    </button>
</div>
