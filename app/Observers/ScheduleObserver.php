<?php

namespace App\Observers;

use App\Enums\ScheduleStatus;
use App\Events\ScheduleWaitForActionEvent;
use App\Models\Schedule;

class ScheduleObserver
{
    /**
     * Handle the Schedule "created" event.
     */
    public function created(Schedule $schedule): void
    {
        //
    }

    /**
     * Handle the Schedule "updated" event.
     */
    public function updated(Schedule $schedule): void
    {
        if ($schedule->isDirty('status') && $schedule->status === ScheduleStatus::WaitForAction) {
            event(new ScheduleWaitForActionEvent($schedule));
        }
    }

    /**
     * Handle the Schedule "deleted" event.
     */
    public function deleted(Schedule $schedule): void
    {
        //
    }

    /**
     * Handle the Schedule "restored" event.
     */
    public function restored(Schedule $schedule): void
    {
        //
    }

    /**
     * Handle the Schedule "force deleted" event.
     */
    public function forceDeleted(Schedule $schedule): void
    {
        //
    }
}
