<?php

namespace App\Data\Web\Exercises\Pages;

use App\Data\Web\Exercises\ExerciseWebData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ExerciseEditProps extends Data
{
    public function __construct(
        public ExerciseWebData $exercise
    ) {}
}
