<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class NotificationController
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->get();

        return Inertia::render('notifications/IndexPage');
    }
}
