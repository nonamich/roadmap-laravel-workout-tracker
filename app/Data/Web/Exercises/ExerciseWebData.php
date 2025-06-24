<?php

namespace App\Data\Web\Exercises;

use App\Models\Exercise;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ExerciseWebData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public string $category,
        public ?string $description,
    ) {}

    public static function fromModel(Exercise $exercise): ExerciseWebData
    {
        return new self(
            id: $exercise->id,
            name: $exercise->name,
            category: $exercise->category,
            description: $exercise->description,
        );
    }
}
