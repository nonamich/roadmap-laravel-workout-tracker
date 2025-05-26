<?php

namespace App\Services;

use App\Data\Schedules\ScheduleStoreData;
use App\Data\Workouts\WorkoutExercisesData;
use App\Data\Workouts\WorkoutRecurrenceData;
use App\Data\Workouts\WorkoutStoreData;
use App\Enums\ScheduleStatus;
use App\Models\Recurrence;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Workout;
use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;

class WorkoutService
{
    public function createWorkout(WorkoutStoreData $data, User $user): Workout
    {
        $workout = DB::transaction(function () use ($data, $user) {
            $workout = $user->workouts()->create([
                'title' => $data->title,
                'description' => $data->description,
                'user_id' => $user->id,
            ]);

            $this->syncExerciseWorkout(
                $workout,
                $data->exercises
            );

            $this->createRecurrences($workout, $data->schedules);

            return $workout;
        });

        assert($workout instanceof Workout);

        return $workout;
    }

    /**
     * @param array<WorkoutExercisesData> $workoutExercisesData
     */
    public function syncExerciseWorkout(Workout $workout, array $workoutExercisesData)
    {
        $syncExercises = collect($workoutExercisesData)
            ->mapWithKeys(fn($item) => [
                $item->exerciseId => [
                    'sets' => $item->sets,
                    'reps' => $item->reps,
                ],
            ]);


        $workout->exercises()->sync($syncExercises);
    }

    /**
     * @param array<WorkoutRecurrenceData> $schedules
     */
    public function createRecurrences(Workout $workout, array $schedules)
    {
        $recurrences = $workout->recurrences()->createMany(
            array_map(
                function (WorkoutRecurrenceData $schedule) {
                    return $schedule->toArray();
                },
                $schedules
            )
        );

        $this->createSchedules($workout);
    }

    /**
     * @param array<WorkoutRecurrenceData> $schedules
     */
    public function createSchedules(
        Workout $workout,
        int $nextDays = 7
    ) {
        $now = Carbon::now();
        $recurrences = $workout->recurrences()->get();

        foreach ($recurrences as $recurrence) {
            for ($i = 0; $i < $nextDays; $i++) {
                $date = $now->copy()->addDays($i);

                if (in_array($date->dayOfWeek, $recurrence->weekdays, true)) {
                    $datetime = $date->copy()->setTimeFromTimeString($recurrence->time);

                    if ($datetime->lessThan($now)) {
                        continue;
                    }

                    $data = ScheduleStoreData::from([
                        'status' => ScheduleStatus::Scheduled,
                        'workoutId' => $workout->id,
                        'recurrenceId' => $recurrence->id,
                        'scheduledAt' => $datetime,
                    ]);

                    $this->createSchedule($data);
                }
            }
        }

    }

    public function createSchedule(ScheduleStoreData $data): Schedule
    {
        return Schedule::create([
            'status' => $data->status,
            'workout_id' => $data->workoutId,
            'recurrence_id' => $data->recurrenceId,
            'scheduled_at' => $data->scheduledAt,
        ]);
    }
}
