<?php

namespace App\Data\Web\Exercises\Pages;

use App\Data\Shared\Exercises\ExerciseData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ExerciseEditProps extends Data
{
    public function __construct(
        public ExerciseData $exercise
    ) {}
}
