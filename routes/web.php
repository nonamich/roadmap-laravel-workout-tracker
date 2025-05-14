<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\WorkoutsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomepageController::class, 'show'])->name('homepage');

Route::middleware('guest')->group(function() {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'destroy'])
        ->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'show']);
    Route::resource('/workouts', WorkoutsController::class);
});

