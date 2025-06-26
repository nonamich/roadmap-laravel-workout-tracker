<?php

namespace App\Http\Controllers\Api;

use App\Data\Api\Exercises\ExerciseWorkoutAttachRequest;
use App\Http\Controllers\BaseController;
use App\Models\Exercise;
use App\Models\Workout;
use App\Services\ExerciseWorkoutService;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;

#[Authenticated]
#[Group('ExerciseWorkout')]
class ExerciseWorkoutController extends BaseController
{
    public function __construct(
        private ExerciseWorkoutService $exerciseWorkoutService,
    ) {}

    public function attach(Workout $workout, Exercise $exercise, ExerciseWorkoutAttachRequest $data): void
    {
        $this->exerciseWorkoutService->attachExercise(
            workout: $workout,
            exercise: $exercise,
            data: $data,
        );
    }

    public function detach(Workout $workout, Exercise $exercise): void
    {
        $this->exerciseWorkoutService->detachExercise(
            workout: $workout,
            exercise: $exercise,
        );
    }
}
