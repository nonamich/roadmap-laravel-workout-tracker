<?php

namespace App\Data\Web\Workouts\Requests;

use App\Models\Exercise;
use App\Rules\ExistsForUserRule;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class WorkoutStoreExercisesWebData extends Data
{
    public function __construct(
        #[Min(1)]
        public int $sets,

        #[Min(1)]
        public int $reps,

        #[Rule(new ExistsForUserRule(Exercise::class))]
        public int $exerciseId,
    ) {}
}
