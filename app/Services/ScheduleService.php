<?php

namespace App\Services;

use App\Data\Schedules\ScheduleStoreData;
use App\Enums\ScheduleStatus;
use App\Models\Schedule;
use App\Models\Workout;
use Carbon\Carbon;

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

    public function createSchedulesByWorkout(
        Workout $workout,
        int $nextDays = 14
    ) {
        $now = Carbon::now();
        $recurrences = $workout->recurrences()->get();

        foreach ($recurrences as $recurrence) {
            $recurrence->schedules()->delete();

            for ($i = 0; $i < $nextDays; $i++) {
                $date = $now->copy()->addDays($i);

                if (in_array($date->dayOfWeek, $recurrence->weekdays, true)) {
                    $datetime = $date->copy()->setTimeFromTimeString($recurrence->time);

                    if ($datetime->lessThan($now)) {
                        continue;
                    }

                    $data = new ScheduleStoreData(
                        status: ScheduleStatus::Scheduled,
                        workoutId: $workout->id,
                        userId: $workout->user_id,
                        recurrenceId: $recurrence->id,
                        scheduledAt: $datetime,
                    );

                    Schedule::create([
                        'status' => $data->status,
                        'workout_id' => $data->workoutId,
                        'user_id' => $data->userId,
                        'recurrence_id' => $data->recurrenceId,
                        'scheduled_at' => $data->scheduledAt,
                    ]);
                }
            }
        }

    }
}
