<?php

use App\Http\Controllers\WorkoutController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('/workouts')->group(function () {
    Route::get('/create', [WorkoutController::class, 'create'])->name('workouts.create');
    Route::get('/', [WorkoutController::class, 'index'])->name('workouts.index');
    Route::post('/', [WorkoutController::class, 'store'])->name('workouts.store');

    Route::prefix('/{workout}')->group(function () {
        Route::get('/', [WorkoutController::class, 'edit'])->name('workouts.edit');
        Route::put('/', [WorkoutController::class, 'update'])->name('workouts.update');
        Route::delete('/', [WorkoutController::class, 'destroy'])->name('workouts.destroy');
    });
});
