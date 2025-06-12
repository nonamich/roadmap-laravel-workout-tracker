<?php

namespace App\Http\Controllers\Web;

use App\Data\Notifications\NotificationData;
use App\Data\Notifications\Pages\Index\NotificationIndexProps;
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
