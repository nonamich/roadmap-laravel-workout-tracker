<?php

namespace App\Data\Exercises\Pages\Edit;

use App\Data\Exercises\ExerciseData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ExerciseEditProps extends Data
{
    public function __construct(
        public ExerciseData $exercise
    ) {}
}
