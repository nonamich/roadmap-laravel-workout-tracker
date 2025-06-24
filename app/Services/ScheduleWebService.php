<?php

namespace App\Services;

use App\Data\Shared\Schedules\ScheduleStoreData;
use App\Models\User;
use App\Models\Workout;
use Carbon\Carbon;

class ScheduleWebService
{
    public function __construct(private ScheduleService $scheduleService) {}

    public function createSchedulesByWorkout(
        Workout $workout,
        int $nextDays = 14
    ): void {
        $now = Carbon::now();
        $recurrences = $workout->recurrences()->get();
        /**
         * @var User
         */
        $user = $workout->user;

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
                        workoutId: $workout->id,
                        recurrenceId: $recurrence->id,
                        scheduledAt: $datetime,
                    );

                    $this->scheduleService->createSchedule($data, $user);
                }
            }
        }

    }
}
