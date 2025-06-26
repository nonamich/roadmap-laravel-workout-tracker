<?php

namespace App\Services;

use App\Data\Api\Exercises\ExerciseWorkoutAttachRequest;
use App\Models\Exercise;
use App\Models\Workout;

class ExerciseWorkoutService
{
    public function attachExercise(Workout $workout, Exercise $exercise, ExerciseWorkoutAttachRequest $data): void
    {
        $workout->exercises()->attach($exercise->id, [
            'sets' => $data->sets,
            'reps' => $data->reps,
            'order' => $data->order,
        ]);
    }

    public function detachExercise(Workout $workout, Exercise $exercise): void
    {
        $workout->exercises()->detach($exercise->id);
    }
}
