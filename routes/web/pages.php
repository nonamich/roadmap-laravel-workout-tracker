<?php

use App\Http\Controllers\Web\HomepageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomepageController::class, 'show'])->name('homepage.show');
