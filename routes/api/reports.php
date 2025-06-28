<?php

use App\Http\Controllers\Api\ReportController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(
    function () {
        Route::get('/reports', [ReportController::class, 'show'])
            ->name('api.reports.show');
    }
);
