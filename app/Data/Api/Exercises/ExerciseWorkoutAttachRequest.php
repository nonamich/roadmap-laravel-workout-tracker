<?php

namespace App\Data\Api\Exercises;

use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;

class ExerciseWorkoutAttachRequest extends Data
{
    public function __construct(
        #[Min(1)]
        public int $sets,

        #[Min(1)]
        public int $reps,

        #[Min(1)]
        public int $order,
    ) {}
}
