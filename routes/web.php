<?php

use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\BinController;
use App\Http\Controllers\Admin\CodexController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\BinScreenController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified', 'role:SuperAdmin'])->name('dashboard');

Route::get('/bin/{bin}', [BinScreenController::class, 'show']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('admin')
    ->middleware(['auth', 'role:SuperAdmin'])
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('stores', StoreController::class);
        Route::resource('bins', BinController::class);
        Route::get('/activity', [ActivityController::class, 'index'])->name('activity.index');
        Route::get('/codex/search', [CodexController::class, 'search'])->name('codex.search');
    });

require __DIR__ . '/auth.php';
