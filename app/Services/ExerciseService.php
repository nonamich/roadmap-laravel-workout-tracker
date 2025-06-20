<?php

namespace App\Services;

use App\Data\Shared\Exercises\ExerciseQueryData;
use App\Data\Shared\Exercises\ExerciseStoreData;
use App\Data\Shared\Exercises\ExerciseUpdateData;
use App\Models\Exercise;
use App\Models\User;
use Illuminate\Pagination\Paginator;

class ExerciseService
{
    /**
     * @return Paginator<int, Exercise>
     */
    public function getPaginatedAndSorted(ExerciseQueryData $dto, ?User $user = null): Paginator
    {
        $query = Exercise::orderBy($dto->sortBy, $dto->sortDir);

        if ($user) {
            $query->where('user_id', '=', $user->id);
        }

        return $query->simplePaginate(
            page: $dto->page,
            perPage: $dto->perPage,
        )->withQueryString();
    }

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
        $exercise->update($data->toArray());

        return $exercise;
    }

    public function destroyExercise(Exercise $exercise): void
    {
        $exercise->delete();
    }
}
