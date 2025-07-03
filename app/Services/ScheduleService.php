<?php

namespace App\Services;

use App\Enums\ScheduleStatus;
use App\Models\Schedule;

class ScheduleService
{
    public function updateStatusToWaitForActionAndSave(): void
    {
        Schedule::outdated()
            ->get()
            ->each(function ($schedule) {
                $schedule->status = ScheduleStatus::WaitForAction;

                $schedule->save();
            });
    }

    public function updateStatusToMissedAndSave(): void
    {
        Schedule::overdue()
            ->get()
            ->each(function ($schedule) {
                $schedule->status = ScheduleStatus::Missed;

                $schedule->save();
            });
    }
}
