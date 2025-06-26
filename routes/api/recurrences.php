<?php

use App\Http\Controllers\Api\RecurrenceResourceController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(
    function () {
        Route::apiResource('/recurrence', RecurrenceResourceController::class)
            ->names('api.recurrence');
    }
);
