<?php

namespace App\Data\Exercises;

use App\Models\Exercise;
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
    ) {}

    public static function fromModel(Exercise $exercise): ExerciseData
    {
        return new self(
            id: $exercise->id,
            name: $exercise->name,
            category: $exercise->category,
            description: $exercise->description,
        );
    }
}
