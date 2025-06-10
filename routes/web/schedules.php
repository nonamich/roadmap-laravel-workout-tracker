<?php

use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('/schedules')->group(function () {
    Route::get('/', [ScheduleController::class, 'index'])->name('schedules.index');

    Route::prefix('/{schedule}', )->group(function () {
        Route::get('/', [ScheduleController::class, 'show'])->name('schedules.show');
        Route::delete('/', [ScheduleController::class, 'destroy'])->name('schedules.destroy');
        Route::post('/mark-as-done', [ScheduleController::class, 'markAsDone'])->name('schedules.mark-as-done');
        Route::post('/mark-as-missed', [ScheduleController::class, 'markAsMissed'])->name('schedules.mark-as-missed');
    });
});
