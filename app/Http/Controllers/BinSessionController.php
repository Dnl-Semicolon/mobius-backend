<?php
namespace App\Http\Controllers;

use App\Models\BinSession;
use App\Models\CupEvent;
use App\Services\BinSessionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BinSessionController extends Controller
{
    public function status(string $bin, BinSessionService $binSessionService): JsonResponse
    {
        $session = $binSessionService->findActiveSession($bin);

        if (!$session) {
            return response()->json([
                'bin_id'             => $bin,
                'has_active_session' => false,
                'cups_count'         => 0,
                'total_points'       => 0,
                'events'             => [],
            ]);
        }

        $events = $this->sessionEvents($session);

        return response()->json([
            'bin_id'             => $session->bin_id,
            'has_active_session' => true,
            'bin_session_id'     => $session->id,
            'cups_count'         => count($events),
            'total_points'       => $session->total_points,
            'status'             => $session->status,
            'events'             => $events,
        ]);
    }

    public function finish(Request $request, BinSessionService $binSessionService): JsonResponse
    {
        $data = $request->validate([
            'bin_id' => ['required', 'string'],
        ]);

        $session = $binSessionService->finishSession($data['bin_id']);

        if (!$session) {
            return response()->json([
                'message' => 'No active session for this bin.',
            ], 404);
        }

        $events = $this->sessionEvents($session);

        return response()->json([
            'success'        => true,
            'bin_session_id' => $session->id,
            'bin_id'         => $session->bin_id,
            'total_points'   => $session->total_points,
            'cups_count'     => count($events),
            'events'         => $events,
            'claim_token'    => $session->claim_token,
            'claim_url'      => sprintf(
                'https://example.com/claim/%s',
                $session->claim_token
            ),
        ]);
    }

    public function show(BinSession $binSession): JsonResponse
    {
        $binSession->load('user');

        return response()->json(
            $this->sessionDetails($binSession)
        );
    }

    /**
     * Transform a session into a JSON-ready payload.
     */
    private function sessionDetails(BinSession $session): array
    {
        $events = $this->sessionEvents($session);

        return [
            'id' => $session->id,
            'bin_id' => $session->bin_id,
            'status' => $session->status,
            'total_points' => $session->total_points,
            'cups_count' => count($events),
            'claim_token' => $session->claim_token,
            'claimed_by' => $session->user
                ? [
                    'id' => $session->user->id,
                    'name' => $session->user->name,
                ]
                : null,
            'events' => $events,
        ];
    }

    /**
     * Format the events belonging to a session.
     *
     * @return list<array{id:int,brand:?string,material:?string,points_awarded:int,created_at:?string}>
     */
    private function sessionEvents(BinSession $session): array
    {
        return $session->cupEvents()
            ->orderBy('created_at')
            ->get()
            ->map(static fn (CupEvent $event) => [
                'id' => $event->id,
                'brand' => $event->brand ?? 'Unknown',
                'material' => $event->material,
                'points_awarded' => (int) $event->points_awarded,
                'created_at' => optional($event->created_at)->toIso8601String(),
            ])
            ->all();
    }
}
