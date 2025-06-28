<?php

namespace App\Data\Api\Reports;

use App\Models\Workout;
use Spatie\LaravelData\Data;

class ReportWorkoutData extends Data
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
