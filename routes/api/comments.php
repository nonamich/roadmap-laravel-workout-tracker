<?php

use App\Http\Controllers\Api\CommentResourceController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(
    function () {
        Route::apiResource('/comments', CommentResourceController::class)
            ->names('api.comments');
    }
);
