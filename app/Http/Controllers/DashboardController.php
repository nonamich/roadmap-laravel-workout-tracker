<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController
{
    public function show() {
        return Inertia::render('DashboardPage');
    }
}
