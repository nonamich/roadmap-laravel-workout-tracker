<?php

namespace App\Data\Shared\Workouts;

use App\Models\Workout;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class WorkoutData extends Data
{
    public function __construct(
        public int $id,
        public string $title,
        public ?string $description,
    ) {}

    public static function fromModel(Workout $workout): self
    {
        return new self(
            id: $workout->id,
            title: $workout->title,
            description: $workout->description,
        );
    }
}
