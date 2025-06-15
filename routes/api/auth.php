<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('/auth')->group(function () {
    Route::middleware('guest:api')->group(function () {
        Route::post('/login', [AuthController::class, 'login'])->name('api.auth.login');
        Route::post('/register', [AuthController::class, 'register'])->name('api.auth.register');
    });

    Route::middleware('auth:api')->group(function () {
        Route::get('/me', [AuthController::class, 'me'])->name('api.auth.me');
        Route::delete('/logout', [AuthController::class, 'logout'])->name('api.auth.logout');
    });
});
