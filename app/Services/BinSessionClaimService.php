<?php

namespace App\Services;

use App\Exceptions\BinSessionAlreadyClaimedException;
use App\Models\BinSession;
use App\Models\CupEvent;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class BinSessionClaimService
{
    /**
     * Claim a pending bin session for a user based on a claim token.
     *
     * @return array{session: BinSession, claimed_points: int}
     */
    public function claimPendingSessionByToken(User $user, string $claimToken): array
    {
        return DB::transaction(function () use ($user, $claimToken): array {
            $session = BinSession::where('claim_token', $claimToken)
                ->lockForUpdate()
                ->first();

            if (!$session) {
                throw new ModelNotFoundException('No session for this claim token.');
            }

            if ($session->status === 'claimed') {
                throw new BinSessionAlreadyClaimedException('This bin session has already been claimed.');
            }

            if ($session->status !== 'pending_claim') {
                throw new ModelNotFoundException('This session is not ready to be claimed.');
            }

            $claimedPoints = (int) $session->total_points;

            $session->user_id = $user->id;
            $session->status = 'claimed';
            $session->save();

            if ($claimedPoints > 0) {
                $user->increment('points', $claimedPoints);
            }

            CupEvent::where('bin_session_id', $session->id)
                ->update(['user_id' => $user->id]);

            return [
                'session' => $session->fresh(),
                'claimed_points' => $claimedPoints,
            ];
        });
    }
}
