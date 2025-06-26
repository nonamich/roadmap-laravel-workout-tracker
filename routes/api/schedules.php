<?php

use App\Http\Controllers\Api\ScheduleResourceController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(
    function () {
        Route::apiResource('/schedules', ScheduleResourceController::class)
            ->names('api.schedules');
    }
);
