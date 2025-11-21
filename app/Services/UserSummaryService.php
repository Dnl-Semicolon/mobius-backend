<?php

namespace App\Services;

use App\Models\CupEvent;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserSummaryService
{
    /**
     * Build the summary payload for a user.
     */
    public function build(User $user, int $recentLimit = 10): array
    {
        $totalCups = CupEvent::where('user_id', $user->id)->count();

        $brandCounts = CupEvent::where('user_id', $user->id)
            ->selectRaw("COALESCE(brand, 'Unknown') as brand_name, COUNT(*) as total")
            ->groupBy('brand_name')
            ->pluck('total', 'brand_name')
            ->toArray();

        return [
            'user_id' => $user->id,
            'name' => $user->name,
            'total_points' => (int) $user->points,
            'total_cups' => $totalCups,
            'by_brand' => $brandCounts,
            'recent_events' => $this->recentEvents($user, $recentLimit),
        ];
    }

    /**
     * Get the recent cup events for a user.
     *
     * @return list<array<string, mixed>>
     */
    public function recentEvents(User $user, int $limit = 10): array
    {
        return CupEvent::where('user_id', $user->id)
            ->latest()
            ->limit($limit)
            ->get()
            ->map(fn (CupEvent $event) => $this->transformEvent($event))
            ->all();
    }

    /**
     * Paginate a user's cup events for history.
     */
    public function paginatedHistory(User $user, int $perPage = 15): LengthAwarePaginator
    {
        return CupEvent::where('user_id', $user->id)
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Provide a consistent JSON structure for a cup event.
     *
     * @return array{id:int,brand:?string,material:?string,points_awarded:int,created_at:?string}
     */
    public function transformEvent(CupEvent $event): array
    {
        return [
            'id' => $event->id,
            'brand' => $event->brand ?? 'Unknown',
            'material' => $event->material,
            'points_awarded' => (int) $event->points_awarded,
            'created_at' => optional($event->created_at)->toIso8601String(),
        ];
    }
}
