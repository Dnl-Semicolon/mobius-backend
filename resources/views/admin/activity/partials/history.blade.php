@php
    $historyAtFormatter = fn ($event) => $event['created_at']
        ? \Carbon\Carbon::parse($event['created_at'])
        : null;
@endphp

<div id="activity-history" hx-target="this" hx-swap="outerHTML" class="rounded bg-white shadow">
    <div class="px-5 py-4 border-b border-gray-200 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-semibold text-gray-900">Claimed Cup History</h3>
            <p class="text-sm text-gray-500">Showing all claimed cup events recorded by the operations account.</p>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50 text-xs uppercase tracking-wide text-gray-500">
                <tr>
                    <th class="px-4 py-3 text-left">Brand</th>
                    <th class="px-4 py-3 text-left">Material</th>
                    <th class="px-4 py-3 text-left">Points</th>
                    <th class="px-4 py-3 text-left">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($history as $event)
                    @php($historyAt = $historyAtFormatter($event))
                    <tr>
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $event['brand'] }}</td>
                        <td class="px-4 py-3 text-gray-600">{{ $event['material'] ?? 'Unknown' }}</td>
                        <td class="px-4 py-3 font-semibold text-emerald-700">+{{ $event['points_awarded'] }} pts</td>
                        <td class="px-4 py-3 text-gray-600">{{ $historyAt ? $historyAt->format('d M Y, h:i A') : '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-sm text-gray-500">No claimed cup events yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-5 py-4 border-t border-gray-200 flex items-center justify-between text-sm">
        <button
            type="button"
            class="rounded border border-gray-300 px-3 py-1.5 {{ $history->onFirstPage() ? 'text-gray-400 cursor-not-allowed' : 'text-gray-700 hover:bg-gray-50' }}"
            @if(!$history->onFirstPage())
                hx-get="{{ $history->previousPageUrl() }}"
                hx-target="#activity-history"
                hx-swap="outerHTML"
                hx-push-url="false"
            @endif
            {{ $history->onFirstPage() ? 'disabled' : '' }}
        >
            Previous
        </button>

        <span class="text-gray-600">
            Page {{ $history->currentPage() }} of {{ $history->lastPage() }}
        </span>

        <button
            type="button"
            class="rounded border border-gray-300 px-3 py-1.5 {{ $history->hasMorePages() ? 'text-gray-700 hover:bg-gray-50' : 'text-gray-400 cursor-not-allowed' }}"
            @if($history->hasMorePages())
                hx-get="{{ $history->nextPageUrl() }}"
                hx-target="#activity-history"
                hx-swap="outerHTML"
                hx-push-url="false"
            @endif
            {{ $history->hasMorePages() ? '' : 'disabled' }}
        >
            Next
        </button>
    </div>
</div>
