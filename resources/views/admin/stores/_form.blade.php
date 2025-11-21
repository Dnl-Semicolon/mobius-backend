@php($editing = isset($store))
@csrf

<!-- Google Maps Places Autocomplete Search -->
<div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded">
    <label class="block text-sm font-medium mb-2">Search on Map</label>
    <input
        type="text"
        id="places-search-input"
        placeholder="Search for a store location (e.g., Lotus Queensbay)"
        class="w-full border rounded px-3 py-2 mb-3"
    >
    <input type="hidden" id="place_id" name="place_id" value="{{ old('place_id', $store->placesCodex->place_id ?? '') }}">
    <div id="map" class="w-full h-64 rounded border hidden"></div>
    <p class="text-xs text-gray-600 mt-2">Start typing to search Google Places. Select a result to auto-fill the form below.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div><label class="block text-sm">Brand Name</label>
        <input name="brand_name" value="{{ old('brand_name', $store->brand_name ?? '') }}" class="w-full border rounded px-3 py-2">
    </div>
    <div><label class="block text-sm">Store Name</label>
        <input id="store_name" name="store_name" value="{{ old('store_name', $store->store_name ?? '') }}" class="w-full border rounded px-3 py-2">
    </div>
    <div class="md:col-span-2"><label class="block text-sm">Address Line 1</label>
        <input id="address_line1" name="address_line1" value="{{ old('address_line1', $store->address_line1 ?? '') }}" class="w-full border rounded px-3 py-2">
    </div>
    <div class="md:col-span-2"><label class="block text-sm">Address Line 2</label>
        <input id="address_line2" name="address_line2" value="{{ old('address_line2', $store->address_line2 ?? '') }}" class="w-full border rounded px-3 py-2">
    </div>
    <div><label class="block text-sm">City</label>
        <input id="city" name="city" value="{{ old('city', $store->city ?? '') }}" class="w-full border rounded px-3 py-2">
    </div>
    <div><label class="block text-sm">State</label>
        <input id="state" name="state" value="{{ old('state', $store->state ?? '') }}" class="w-full border rounded px-3 py-2">
    </div>
    <div><label class="block text-sm">Country</label>
        <input id="country" name="country" value="{{ old('country', $store->country ?? '') }}" class="w-full border rounded px-3 py-2">
    </div>
    <div><label class="block text-sm">Postal Code</label>
        <input id="postal_code" name="postal_code" value="{{ old('postal_code', $store->postal_code ?? '') }}" class="w-full border rounded px-3 py-2">
    </div>
    <div><label class="block text-sm">Latitude</label>
        <input id="lat" name="lat" type="number" step="0.000001" value="{{ old('lat', $store->lat ?? '') }}" class="w-full border rounded px-3 py-2">
    </div>
    <div><label class="block text-sm">Longitude</label>
        <input id="lng" name="lng" type="number" step="0.000001" value="{{ old('lng', $store->lng ?? '') }}" class="w-full border rounded px-3 py-2">
    </div>
    <div><label class="block text-sm">Timezone</label>
        <input id="timezone" name="timezone" value="{{ old('timezone', $store->timezone ?? 'Asia/Kuala_Lumpur') }}" class="w-full border rounded px-3 py-2">
    </div>
    <div><label class="block text-sm">Status</label>
        <select name="status" class="w-full border rounded px-3 py-2">
            <option value="active" {{ old('status',$store->status ?? '')==='active'?'selected':'' }}>Active</option>
            <option value="inactive" {{ old('status',$store->status ?? '')==='inactive'?'selected':'' }}>Inactive</option>
        </select>
    </div>
</div>
<div class="mt-6">
    <button class="px-4 py-2 bg-blue-600 text-white rounded">{{ $editing ? 'Update' : 'Create' }}</button>
    <a href="{{ route('admin.stores.index') }}" class="ml-2 px-4 py-2 border rounded">Cancel</a>
</div>
