<?php

namespace App\Data\Exercises;

use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ExerciseData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $category,
        public ?string $description,
    ) {
    }
}
