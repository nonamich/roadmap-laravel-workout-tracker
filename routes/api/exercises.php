<?php

use App\Http\Controllers\Api\ExerciseResourceController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(
    function () {
        Route::apiResource('/exercises', ExerciseResourceController::class)
            ->names('api.exercises');
    }
);
