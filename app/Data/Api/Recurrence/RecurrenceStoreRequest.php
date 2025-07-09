<?php

namespace App\Data\Api\Recurrence;

use App\Models\Workout;
use App\Rules\ExistsForUserRule;
use App\Rules\TimeRule;
use App\Rules\WeekdaysRule;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class RecurrenceStoreRequest extends Data
{
    /**
     * @param  int[]  $weekdays
     */
    public function __construct(
        public string $name,

        #[Rule(new WeekdaysRule)]
        public array $weekdays,

        #[Rule(new TimeRule)]
        public string $time,

        #[Rule(new ExistsForUserRule(Workout::class))]
        public string $workoutId,
    ) {}
}
