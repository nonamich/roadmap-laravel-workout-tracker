<?php

namespace App\Services;

use App\Data\Exercises\ExerciseStoreData;
use App\Data\Workouts\WorkoutStoreData;
use App\Models\Exercise;
use App\Models\User;
use App\Models\Workout;
use Illuminate\Auth\Authenticatable;

class WorkoutService
{
    public function storeWorkout(WorkoutStoreData $data, User $user): Workout
    {
        $workout = $user->workouts()->create([
            'title' => $data->title,
            'description' => $data->description,
            'user_id' => $user->id,
        ]);

        $workout->exercises()->sync(
            array_
        );

        foreach ($data->exercises as $exercise) {
            $exercise->exerciseId;

            $workout->comments();
        }
    }
}
