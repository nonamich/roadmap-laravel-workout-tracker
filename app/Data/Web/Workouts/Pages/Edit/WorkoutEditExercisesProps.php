<?php

namespace App\Data\Web\Workouts\Pages\Edit;

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
            // @phpstan-ignore property.notFound
            reps: $exercise->pivot->reps,
            // @phpstan-ignore property.notFound
            sets: $exercise->pivot->sets,
        );
    }
}
