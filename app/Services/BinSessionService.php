<?php

namespace App\Services;

use App\Models\Bin;
use App\Models\BinSession;
use App\Models\CupEvent;
use Illuminate\Support\Str;

class BinSessionService
{
    public function findActiveSession(string $binId): ?BinSession
    {
        $this->touchBin($binId);

        return BinSession::where('bin_id', $binId)
            ->where('status', 'active')
            ->first();
    }

    public function getOrCreateActiveSession(string $binId): BinSession
    {
        $this->touchBin($binId);

        return BinSession::firstOrCreate(
            [
                'bin_id' => $binId,
                'status' => 'active',
            ],
            [
                'total_points' => 0,
            ]
        );
    }

    public function addPointsToSession(BinSession $session, int $points): BinSession
    {
        $session->total_points += $points;
        $session->save();

        return $session;
    }

    public function attachEventToSession(BinSession $session, CupEvent $event): void
    {
        $event->bin_session_id = $session->id;
        $event->save();
    }

    public function finishSession(string $binId): ?BinSession
    {
        $this->touchBin($binId);

        $session = $this->findActiveSession($binId);

        if (!$session) {
            return null;
        }

        $session->status = 'pending_claim';
        $session->claim_token = Str::uuid()->toString();
        $session->save();

        return $session;
    }

    private function touchBin(string $hardwareIdentifier): ?Bin
    {
        $bin = Bin::where('hardware_identifier', $hardwareIdentifier)->first();

        if ($bin) {
            $bin->forceFill([
                'last_seen_at' => now(),
            ])->save();
        }

        return $bin;
    }
}
