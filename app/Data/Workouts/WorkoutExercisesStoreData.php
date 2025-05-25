<?php

namespace App\Data\Workouts;

use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class WorkoutExercisesStoreData extends Data
{
    public function __construct(
        #[Min(1)]
        public int $sets,

        #[Min(1)]
        public int $reps,

        public int $exerciseId,
    ) {
    }
}
