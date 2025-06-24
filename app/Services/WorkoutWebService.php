<?php

namespace App\Services;

use App\Data\Web\Workouts\WorkoutStoreExercisesWebData;
use App\Data\Web\Workouts\WorkoutStoreWebData;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Support\Facades\DB;

class WorkoutWebService
{
    public function __construct(private RecurrenceWebService $recurrenceWebService) {}

    public function createOrUpdate(WorkoutStoreWebData $dto, User $user): Workout
    {
        $workout = DB::transaction(function () use ($dto, $user) {
            if ($dto->id) {
                $workout = Workout::findOrFail($dto->id);
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

            $this->recurrenceWebService->createOrUpdate($workout, $dto->recurrences);

            return $workout;
        });

        return $workout;
    }

    /**
     * @param  array<WorkoutStoreExercisesWebData>  $workoutExercisesData
     */
    public function syncExerciseWorkout(Workout $workout, array $workoutExercisesData): void
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
