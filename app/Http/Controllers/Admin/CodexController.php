<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlacesCodex;
use Illuminate\Http\Request;

class CodexController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('q', '');

        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $results = PlacesCodex::where('display_name', 'like', "%{$query}%")
            ->orWhere('address_line1', 'like', "%{$query}%")
            ->orWhere('city', 'like', "%{$query}%")
            ->orderBy('last_verified_at', 'desc')
            ->limit(10)
            ->get(['id', 'place_id', 'display_name', 'address_line1', 'city', 'state', 'country', 'postal_code', 'lat', 'lng', 'timezone']);

        return response()->json($results);
    }
}
