<?php

namespace App\Services;

use App\Data\Shared\Exercises\ExerciseStoreData;
use App\Data\Shared\Exercises\ExerciseUpdateData;
use App\Models\Exercise;
use App\Models\User;

class ExerciseService
{
    public function storeExercise(ExerciseStoreData $data, User $user): Exercise
    {
        return Exercise::create([
            'name' => $data->name,
            'category' => $data->category,
            'description' => $data->description,
            'user_id' => $user->id,
        ]);
    }

    public function updateExercise(Exercise $exercise, ExerciseUpdateData $data): Exercise
    {
        $exercise->update([
            'name' => $data->name,
            'category' => $data->category,
            'description' => $data->description,
        ]);

        return $exercise;
    }

    public function destroyExercise(Exercise $exercise): void
    {
        $exercise->delete();
    }
}
