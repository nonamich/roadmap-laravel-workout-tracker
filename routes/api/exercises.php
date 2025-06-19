<?php

use App\Http\Controllers\Api\ExerciseController;
use Illuminate\Support\Facades\Route;

// Route::middleware('api')->group(
//     function () {
//         Route::get('/test', [ExerciseController::class, 'test']);
//     }
// );

Route::middleware('auth:api')->as('exercises:')->group(
    function () {
        Route::apiResource('/exercises', ExerciseController::class)
            ->names('api.exercises');
    }
);
