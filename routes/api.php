<?php

use App\Http\Controllers\BinSessionController;
use App\Http\Controllers\CupEventController;
use App\Http\Controllers\Mobile\MobileClaimController;
use App\Http\Controllers\Mobile\MobileUserController;
use Illuminate\Support\Facades\Route;

Route::post('/cup-events', [CupEventController::class, 'store']);
Route::get('/bin-sessions/{bin}/status', [BinSessionController::class, 'status']);
Route::post('/bin-sessions/finish', [BinSessionController::class, 'finish']);
Route::get('/bin-sessions/{binSession}', [BinSessionController::class, 'show']);

Route::prefix('mobile')->group(function () {
    Route::get('/users/{user}/summary', [MobileUserController::class, 'summary']);
    Route::get('/users/{user}/history', [MobileUserController::class, 'history']);
    Route::get('/users/{user}/profile', [MobileUserController::class, 'profile']);
    Route::post('/claim', [MobileClaimController::class, 'store']);
});
