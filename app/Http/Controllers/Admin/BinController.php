<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BinUpsertRequest;
use App\Models\Bin;
use App\Models\Store;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BinController extends Controller
{
    public function index(Request $request): View
    {
        $query = Bin::with('store')
            ->orderByDesc('created_at');

        if ($search = $request->get('q')) {
            $query->where(function ($builder) use ($search) {
                $builder
                    ->where('name', 'like', "%{$search}%")
                    ->orWhere('hardware_identifier', 'like', "%{$search}%");
            });
        }

        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        $bins = $query->paginate(12)->appends($request->query());

        return view('admin.bins.index', [
            'bins' => $bins,
        ]);
    }

    public function create(): View
    {
        return view('admin.bins.create', [
            'stores' => $this->storeOptions(),
            'bin' => new Bin([
                'status' => 'active',
            ]),
        ]);
    }

    public function store(BinUpsertRequest $request): RedirectResponse
    {
        Bin::create($request->validated());

        return redirect()
            ->route('admin.bins.index')
            ->with('success', 'Bin created.');
    }

    public function edit(Bin $bin): View
    {
        return view('admin.bins.edit', [
            'bin' => $bin,
            'stores' => $this->storeOptions(),
        ]);
    }

    public function update(BinUpsertRequest $request, Bin $bin): RedirectResponse
    {
        $bin->update($request->validated());

        return redirect()
            ->route('admin.bins.index')
            ->with('success', 'Bin updated.');
    }

    public function destroy(Bin $bin): RedirectResponse
    {
        $bin->delete();

        return back()->with('success', 'Bin deleted.');
    }

    private function storeOptions()
    {
        return Store::orderBy('store_name')->get();
    }
}
