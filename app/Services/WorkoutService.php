<?php

namespace App\Services;

use App\Data\Workouts\Store\WorkoutStoreData;
use App\Data\Workouts\Store\WorkoutStoreExercisesData;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Support\Facades\DB;

class WorkoutService
{
    public function __construct(private RecurrenceService $recurrenceService) {}

    public function createOrUpdate(WorkoutStoreData $dto, User $user): Workout
    {
        $workout = DB::transaction(function () use ($dto, $user) {
            if ($dto->id) {
                $workout = Workout::find($dto->id);
            } else {
                $workout = $user->workouts()->create([
                    'title' => $dto->title,
                    'description' => $dto->description,
                    'user_id' => $user->id,
                ]);
            }

            $this->syncExerciseWorkout(
                $workout,
                $dto->exercises
            );

            $this->recurrenceService->createOrUpdate($workout, $dto->recurrences);

            return $workout;
        });

        assert($workout instanceof Workout);

        return $workout;
    }

    /**
     * @param  array<WorkoutStoreExercisesData>  $workoutExercisesData
     */
    public function syncExerciseWorkout(Workout $workout, array $workoutExercisesData)
    {
        $workout->exercises()->detach();

        foreach ($workoutExercisesData as $index => $dto) {
            $workout->exercises()->attach($dto->exerciseId, [
                'sets' => $dto->sets,
                'reps' => $dto->reps,
                'order' => $index,
            ]);
        }

    }
}
