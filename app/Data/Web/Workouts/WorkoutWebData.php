<?php

namespace App\Data\Web\Workouts;

use App\Models\Workout;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class WorkoutWebData extends Data
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
