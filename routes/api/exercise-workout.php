<?php

use App\Http\Controllers\Api\ExerciseWorkoutController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->prefix('/exercise-workout')->group(
    function () {
        Route::prefix('/{exercise}/{workout}')->group(function () {
            Route::post('/attach', [ExerciseWorkoutController::class, 'attach']);
            Route::delete('/detach', [ExerciseWorkoutController::class, 'detach']);
        });
    }
);
