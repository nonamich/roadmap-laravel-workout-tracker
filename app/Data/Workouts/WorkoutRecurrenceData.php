<?php

namespace App\Data\Workouts;

use App\Rules\WeekdaysRule;
use Spatie\LaravelData\Attributes\Validation\Regex;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class WorkoutRecurrenceData extends Data
{
    public function __construct(
        public string $name,

        #[Rule([new WeekdaysRule()])]
        /** @var int[] */
        public array $weekdays,

        #[Regex('/^[0-2]\d:[0-5]\d$/')]
        public string $time,
    ) {
    }
}
