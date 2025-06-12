<?php

use App\Http\Controllers\Web\NotificationController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('/notifications')->group(function () {
    Route::get('/', [NotificationController::class, 'index'])
        ->name('notifications.index');
});
