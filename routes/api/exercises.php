<?php

use App\Http\Controllers\Api\ExerciseController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\WorkoutController;
use Illuminate\Support\Facades\Route;

// Route::middleware('api')->group(
//     function () {
//         Route::get('/test', [ExerciseController::class, 'test']);
//     }
// );

Route::middleware('auth:api')->group(
    function () {
        Route::apiResource('/exercises', ExerciseController::class)
            ->names('api.exercises');

        Route::apiResource('/workouts', WorkoutController::class)
            ->names('api.workouts');

        Route::apiResource('/schedules', ScheduleController::class)
            ->names('api.schedules');
    }
);
