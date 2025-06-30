<?php

namespace App\Data\Api\Reports;

use App\Models\Exercise;
use App\Models\ExerciseWorkout;
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
        assert($exercise->pivot instanceof ExerciseWorkout);

        return new self(
            id: $exercise->id,
            name: $exercise->name,
            description: $exercise->description,
            sets: $exercise->pivot->sets,
            reps: $exercise->pivot->reps,
        );
    }
}
