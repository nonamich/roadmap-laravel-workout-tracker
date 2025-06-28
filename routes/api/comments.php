<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\CommentResourceController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(
    function () {
        Route::apiResource('/comments', CommentResourceController::class)
            ->except(['store'])
            ->names('api.comments');

        Route::post(
            '/comments/schedule/{schedule}',
            [CommentController::class, 'storeSchedule']
        )->name('api.comments.schedule');

        Route::post(
            '/comments/workout/{workout}',
            [CommentController::class, 'storeWorkout']
        )->name('api.comments.workout');
    }
);
