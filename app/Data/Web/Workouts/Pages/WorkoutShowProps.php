<?php

namespace App\Data\Web\Workouts\Pages;

use App\Data\Web\Workouts\WorkoutData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class WorkoutShowProps extends Data
{
    public function __construct(
        public WorkoutData $workout,
    ) {}
}
