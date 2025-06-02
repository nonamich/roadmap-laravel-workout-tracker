<?php

namespace App\Services;

use App\Data\Exercises\ExerciseStoreData;
use App\Data\Exercises\ExerciseUpdateData;
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

    public function updateExercise(Exercise $exercise, ExerciseUpdateData $data)
    {
        $exercise->update([
            'name' => $data->name,
            'category' => $data->category,
            'description' => $data->description,
        ]);
    }
}
