<?php

namespace App\Services;

use App\Data\Api\Schedules\Requests\ScheduleStoreApiData;
use App\Data\Api\Schedules\Requests\ScheduleUpdateApiData;
use App\Enums\ScheduleStatus;
use App\Models\Schedule;

class ScheduleService
{
    public function storeSchedule(ScheduleStoreApiData $data): Schedule
    {
        return Schedule::create($data->toArray());
    }

    public function updateSchedule(Schedule $schedule, ScheduleUpdateApiData $data): Schedule
    {
        $schedule->update($data->toArray());

        return $schedule;
    }

    public function deleteSchedule(Schedule $schedule): void
    {
        $schedule->delete();
    }

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
