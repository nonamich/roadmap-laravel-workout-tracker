<?php

namespace App\Services;

use App\Data\StoreExerciseData;
use App\Data\UpdateExerciseData;
use App\Models\Exercise;

class ExerciseService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function storeExercise(StoreExerciseData $data): Exercise
    {
        return Exercise::create([
            'name' => $data->name,
            'category' => $data->category,
            'description' => $data->description,
            'user_id' => $data->userId,
        ]);
    }

    public function updateExercise(Exercise $exercise, UpdateExerciseData $data)
    {
        $exercise->update([
            'name' => $data->name,
            'category' => $data->category,
            'description' => $data->description,
        ]);
    }
}
