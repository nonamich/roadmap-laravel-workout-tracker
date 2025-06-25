<?php

namespace App\Services;

use App\Models\Schedule;
use App\Models\User;
use App\Models\Workout;
use Carbon\Carbon;

class ScheduleWebService
{
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

                    Schedule::create([
                        'user_id' => $user->id,
                        'workout_id' => $workout->id,
                        'recurrence_id' => $recurrence->id,
                        'scheduled_at' => $datetime,
                    ]);
                }
            }
        }

    }
}
