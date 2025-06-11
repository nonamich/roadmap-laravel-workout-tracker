<?php

namespace App\Data\Workouts\Pages;

use App\Data\Workouts\WorkoutData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class WorkoutShowProps extends Data
{
    public function __construct(
        public WorkoutData $workout,
    ) {}
}
