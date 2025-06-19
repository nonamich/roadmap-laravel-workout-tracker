<?php

namespace App\Http\Controllers\Api;

use App\Data\Shared\Exercises\ExerciseStoreData;
use App\Data\Shared\Exercises\ExerciseUpdateData;
use App\Http\Controllers\BaseController;
use App\Models\Exercise;
use App\Services\ExerciseService;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Subgroup;

#[Authenticated]
#[Subgroup('Exercise')]
class ExerciseController extends BaseController
{
    public function __construct(private ExerciseService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): void
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExerciseStoreData $dto): Exercise
    {
        $user = auth()->user();

        if (! $user) {
            abort(401);
        }

        return $this->service->storeExercise($dto, $user);
    }

    /**
     * Display the specified resource.
     */
    public function show(Exercise $exercise): Exercise
    {
        return $exercise;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Exercise $exercise, ExerciseUpdateData $data): Exercise
    {
        return $this->service->updateExercise($exercise, $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exercise $exercise): void
    {
        $this->service->destroyExercise($exercise);
    }
}
