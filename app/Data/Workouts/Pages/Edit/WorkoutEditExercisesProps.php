<?php

namespace App\Data\Workouts\Pages\Edit;

use App\Models\Exercise;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class WorkoutEditExercisesProps extends Data
{
    public function __construct(
        public int $exerciseId,
        public int $sets,
        public int $reps,
    ) {}

    public static function fromModel(Exercise $exercise): WorkoutEditExercisesProps
    {
        return new self(
            exerciseId: $exercise->id,
            reps: $exercise->pivot->reps,
            sets: $exercise->pivot->sets,
        );
    }
}
