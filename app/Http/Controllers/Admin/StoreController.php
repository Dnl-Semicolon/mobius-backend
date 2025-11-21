<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpsertRequest;
use App\Models\PlacesCodex;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index() {
        $stores = Store::latest()->paginate(10);
        return view('admin.stores.index', compact('stores'));
    }

    public function create() {
        return view('admin.stores.create');
    }

    public function store(StoreUpsertRequest $request) {
        $data = $request->validated();

        // Handle places_codex upsert if place_id is provided
        $codexId = $this->upsertPlacesCodex($data);
        if ($codexId) {
            $data['codex_id'] = $codexId;
        }

        // Remove place_id before storing in stores table
        unset($data['place_id']);

        Store::create($data);
        return redirect()->route('admin.stores.index')->with('success','Store created.');
    }

    public function edit(Store $store) {
        return view('admin.stores.edit', compact('store'));
    }

    public function update(StoreUpsertRequest $request, Store $store) {
        $data = $request->validated();

        // Handle places_codex upsert if place_id is provided
        $codexId = $this->upsertPlacesCodex($data);
        if ($codexId) {
            $data['codex_id'] = $codexId;
        }

        // Remove place_id before updating stores table
        unset($data['place_id']);

        $store->update($data);
        return redirect()->route('admin.stores.index')->with('success','Store updated.');
    }

    public function destroy(Store $store) {
        $store->delete();
        return back()->with('success','Store deleted.');
    }

    /**
     * Upsert places_codex entry based on place_id
     *
     * @param array $data
     * @return int|null The codex ID or null if no place_id provided
     */
    private function upsertPlacesCodex(array $data): ?int
    {
        if (empty($data['place_id'])) {
            return null;
        }

        $codex = PlacesCodex::updateOrCreate(
            ['place_id' => $data['place_id']],
            [
                'display_name' => $data['store_name'] ?? '',
                'address_line1' => $data['address_line1'] ?? null,
                'city' => $data['city'] ?? null,
                'state' => $data['state'] ?? null,
                'country' => $data['country'] ?? null,
                'postal_code' => $data['postal_code'] ?? null,
                'lat' => $data['lat'] ?? null,
                'lng' => $data['lng'] ?? null,
                'timezone' => $data['timezone'] ?? null,
                'source' => 'google',
                'last_verified_at' => now(),
            ]
        );

        return $codex->id;
    }
}
