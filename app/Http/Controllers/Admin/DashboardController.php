<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_stores' => Store::count(),
            'active_stores' => Store::where('status', 'active')->count(),
            'inactive_stores' => Store::where('status', 'inactive')->count(),
            'total_bins' => 0, // TODO: Add Bin model count when available
            'recycling_today' => 0, // TODO: Add recycling transactions count
            'recycling_this_month' => 0, // TODO: Add monthly recycling count
        ];

        $recent_stores = Store::with('placesCodex')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_stores'));
    }
}
