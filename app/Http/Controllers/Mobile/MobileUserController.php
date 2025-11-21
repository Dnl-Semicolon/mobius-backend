<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\UserSummaryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MobileUserController extends Controller
{
    public function profile(int $userId): JsonResponse
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'message' => 'User not found.',
            ], 404);
        }

        return response()->json([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'points' => (int) $user->points,
            'avatar_url' => $user->avatar_url ?: $this->defaultAvatarUrl($user),
        ]);
    }

    public function summary(User $user, UserSummaryService $userSummaryService): JsonResponse
    {
        return response()->json(
            $userSummaryService->build($user)
        );
    }

    public function history(Request $request, User $user, UserSummaryService $userSummaryService): JsonResponse
    {
        $data = $request->validate([
            'per_page' => ['sometimes', 'integer', 'min:1', 'max:100'],
        ]);

        $perPage = $data['per_page'] ?? 15;

        $paginator = $userSummaryService
            ->paginatedHistory($user, $perPage)
            ->appends($request->query());

        $events = $paginator->getCollection()
            ->map(fn ($event) => $userSummaryService->transformEvent($event))
            ->all();

        return response()->json([
            'data' => $events,
            'meta' => [
                'current_page' => $paginator->currentPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'last_page' => $paginator->lastPage(),
                'from' => $paginator->firstItem(),
                'to' => $paginator->lastItem(),
            ],
            'links' => [
                'first' => $paginator->url(1),
                'last' => $paginator->url($paginator->lastPage()),
                'prev' => $paginator->previousPageUrl(),
                'next' => $paginator->nextPageUrl(),
            ],
        ]);
    }

    private function defaultAvatarUrl(User $user): string
    {
        return sprintf(
            'https://www.gravatar.com/avatar/%s?d=mp',
            md5(strtolower(trim($user->email)))
        );
    }
}
