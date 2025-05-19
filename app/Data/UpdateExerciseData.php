<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class UpdateExerciseData extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $category,
        public readonly ?string $description,
    ) {}
}
