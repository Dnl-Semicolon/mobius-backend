<?php

namespace App\Http\Controllers\Mobile;

use App\Exceptions\BinSessionAlreadyClaimedException;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\BinSessionClaimService;
use App\Services\UserSummaryService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MobileClaimController extends Controller
{
    public function store(
        Request $request,
        BinSessionClaimService $claimService,
        UserSummaryService $userSummaryService
    ): JsonResponse {
        $data = $request->validate([
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'claim_token' => ['required', 'string'],
        ]);

        $user = User::findOrFail($data['user_id']);

        try {
            $result = $claimService->claimPendingSessionByToken($user, $data['claim_token']);
        } catch (BinSessionAlreadyClaimedException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'This claim token has already been used.',
            ], 409);
        } catch (ModelNotFoundException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Claim token is invalid or expired.',
            ], 404);
        }

        $user->refresh();

        return response()->json([
            'success' => true,
            'message' => 'Points claimed successfully.',
            'claimed_points' => $result['claimed_points'],
            'user_summary' => $userSummaryService->build($user),
        ]);
    }
}
