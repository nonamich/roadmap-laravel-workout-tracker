<?php

use App\Http\Controllers\Api\WorkoutResourceController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(
    function () {
        Route::apiResource('/workouts', WorkoutResourceController::class)
            ->names('api.workouts');
    }
);
