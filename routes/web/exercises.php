<?php

use App\Http\Controllers\Web\ExerciseController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('/exercises')->group(function () {
    Route::get('/create', [ExerciseController::class, 'create'])->name('exercises.create');
    Route::get('/', [ExerciseController::class, 'index'])->name('exercises.index');
    Route::post('/', [ExerciseController::class, 'store'])->name('exercises.store');

    Route::prefix('/{exercise}')->group(function () {
        Route::get('/', [ExerciseController::class, 'edit'])->name('exercises.edit');
        Route::put('/', [ExerciseController::class, 'update'])->name('exercises.update');
        Route::delete('/', [ExerciseController::class, 'destroy'])->name('exercises.destroy');
    });
});
