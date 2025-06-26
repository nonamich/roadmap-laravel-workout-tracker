<?php

namespace App\Services;

use App\Enums\ScheduleStatus;
use App\Models\Schedule;

class ScheduleService
{
    public function updateStatusToWaitForActionAndSave(): void
    {
        Schedule::where('scheduled_at', '<', now())
            ->where('status', '=', ScheduleStatus::Scheduled)
            ->get()
            ->each(function ($schedule) {
                $schedule->status = ScheduleStatus::WaitForAction;

                $schedule->save();
            });
    }

    public function updateStatusToMissedAndSave(): void
    {
        Schedule::query()
            ->where('scheduled_at', '<', now()->subDay())
            ->whereIn('status', [ScheduleStatus::WaitForAction, ScheduleStatus::Scheduled])
            ->get()
            ->each(function ($schedule) {
                $schedule->status = ScheduleStatus::Missed;

                $schedule->save();
            });
    }
}
