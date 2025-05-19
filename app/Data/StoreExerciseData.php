<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class StoreExerciseData extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $category,
        public readonly ?string $description,
        public readonly int $userId,
    ) {}
}
