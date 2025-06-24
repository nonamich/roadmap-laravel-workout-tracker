<?php

namespace App\Services;

use App\Data\Api\Schedules\ScheduleStoreApiData;
use App\Data\Api\Schedules\ScheduleUpdateApiData;
use App\Data\Shared\Schedules\ScheduleStoreData;
use App\Enums\ScheduleStatus;
use App\Models\Schedule;
use App\Models\User;

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

    public function createSchedule(ScheduleStoreData $data, User $user): Schedule
    {
        return Schedule::create([
            'user_id' => $user->id,
            'workout_id' => $data->workoutId,
            'recurrence_id' => $data->recurrenceId,
            'scheduled_at' => $data->scheduledAt,
        ]);
    }
}
