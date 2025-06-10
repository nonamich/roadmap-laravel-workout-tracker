<?php

namespace App\Listeners;

use App\Events\ScheduleWaitForActionEvent;
use App\Notifications\NotifyWaitForAction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class SendScheduleNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(ScheduleWaitForActionEvent $event): void
    {
        Notification::send(
            $event->schedule->user,
            new NotifyWaitForAction($event->schedule->id)
        );
    }
}
