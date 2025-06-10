<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\WorkoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomepageController::class, 'show'])->name('homepage');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'destroy'])
        ->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'show'])->name('dashboard');
    Route::resource('/workouts', WorkoutController::class)->names('workouts');
    Route::resource('/exercises', ExerciseController::class)->names('exercises');

    Route::name('schedules.')->prefix('/schedules')->group(function () {
        Route::get('/', [ScheduleController::class, 'index'])->name('index');
        Route::prefix('/{schedule}', )->group(function () {
            Route::delete('/', [ScheduleController::class, 'destroy'])->name('destroy');
            Route::post('/mark-as-done', [ScheduleController::class, 'markAsDone'])->name('mark-as-done');
            Route::post('/mark-as-missed', [ScheduleController::class, 'markAsMissed'])->name('mark-as-missed');
        });
    });
});

