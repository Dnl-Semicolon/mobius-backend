<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CupEvent;
use App\Services\BinSessionService;

class CupEventController extends Controller
{
    public function store(Request $request, BinSessionService $binSessionService)
    {
        $data = $request->validate([
            'bin_id' => 'nullable|string',
            'user_id' => 'nullable|integer',
            'ai_result' => 'required|array',
        ]);

        $ai = $data['ai_result'];

        // Points logic here
        $points = 0;
        if (!empty($ai['is_cup'])) {
            $points += 10;
            if (!empty($ai['has_lid'])) {
                $points += 5;
            }
            if (!empty($ai['has_straw'])) {
                $points += 5;
            }
        }

        $event = CupEvent::create([
            'user_id'       => $data['user_id'] ?? null,
            'bin_id'        => $data['bin_id'] ?? null,
            'brand'         => $ai['brand'] ?? 'Unknown',
            'material'      => $ai['material'] ?? null,
            'has_lid'       => $ai['has_lid'] ?? false,
            'lid_material'  => $ai['lid_material'] ?? null,
            'has_straw'     => $ai['has_straw'] ?? false,
            'straw_material'=> $ai['straw_material'] ?? null,
            'confidence'    => $ai['confidence'] ?? 0,
            'points_awarded'=> $points,
        ]);

        if (!empty($data['bin_id'])) {
            $session = $binSessionService->getOrCreateActiveSession($data['bin_id']);
            $binSessionService->addPointsToSession($session, $points);
            $binSessionService->attachEventToSession($session, $event);
        }

        return response()->json([
            'success' => true,
            'event'   => $event,
        ]);
    }
}
