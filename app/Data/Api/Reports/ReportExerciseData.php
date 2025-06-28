<?php

namespace App\Data\Api\Reports;

use App\Models\Exercise;
use Spatie\LaravelData\Data;

class ReportExerciseData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public ?string $description,
        public int $sets,
        public int $reps,
    ) {}

    public static function fromModel(Exercise $exercise): self
    {
        return new self(
            id: $exercise->id,
            name: $exercise->name,
            description: $exercise->description,
            // @phpstan-ignore property.notFound
            sets: $exercise->pivot->sets,
            // @phpstan-ignore property.notFound
            reps: $exercise->pivot->reps,
        );
    }
}
