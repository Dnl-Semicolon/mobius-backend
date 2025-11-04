<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpsertRequest;
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
        Store::create($request->validated());
        return redirect()->route('admin.stores.index')->with('success','Store created.');
    }

    public function edit(Store $store) {
        return view('admin.stores.edit', compact('store'));
    }

    public function update(StoreUpsertRequest $request, Store $store) {
        $store->update($request->validated());
        return redirect()->route('admin.stores.index')->with('success','Store updated.');
    }

    public function destroy(Store $store) {
        $store->delete();
        return back()->with('success','Store deleted.');
    }
}
