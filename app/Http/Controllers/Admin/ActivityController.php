<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\UserSummaryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    private const OPERATIONS_NAME = 'Mobius Operations';

    public function index(Request $request, UserSummaryService $userSummaryService): View
    {
        $user = $request->user();

        $summary = $userSummaryService->build($user);
        $history = $userSummaryService
            ->paginatedHistory($user, 10)
            ->through(fn ($event) => $userSummaryService->transformEvent($event));

        $viewData = [
            'operationsName' => self::OPERATIONS_NAME,
            'summary' => $summary,
            'history' => $history,
        ];

        if ($request->header('HX-Request')) {
            return view('admin.activity.partials.history', $viewData);
        }

        return view('admin.activity.index', $viewData);
    }
}
