<?php

namespace App\Observers;

use App\Enums\ScheduleStatus;
use App\Events\ScheduleWaitForActionEvent;
use App\Models\Schedule;

class ScheduleObserver
{
    public function updated(Schedule $schedule): void
    {
        if ($schedule->isDirty('status') && $schedule->status === ScheduleStatus::WaitForAction) {
            event(new ScheduleWaitForActionEvent($schedule));
        }
    }
}
