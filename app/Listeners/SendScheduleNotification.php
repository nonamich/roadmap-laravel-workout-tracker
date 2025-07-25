<?php

namespace App\Listeners;

use App\Events\ScheduleWaitForActionEvent;
use App\Notifications\NotificationWaitForAction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendScheduleNotification implements ShouldQueue
{
    /**
     * Handle the event.
     */
    public function handle(ScheduleWaitForActionEvent $event): void
    {
        Notification::send(
            $event->schedule->user,
            new NotificationWaitForAction($event->schedule->id)
        );
    }
}
