<?php

namespace App\Http\Controllers;

use App\Data\Notifications\NotificationData;
use App\Data\Notifications\Pages\Index\NotificationIndexProps;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\LaravelData\DataCollection;

class NotificationController
{
    public function index()
    {
        $notifications = auth()->user()->notifications()->get();
        $props = new NotificationIndexProps(
            notifications: NotificationData::collect($notifications, DataCollection::class),
        );

        return Inertia::render('notifications/IndexPage', $props);
    }
}
