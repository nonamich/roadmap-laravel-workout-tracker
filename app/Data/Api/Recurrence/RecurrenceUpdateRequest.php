<?php

namespace App\Data\Api\Recurrence;

use App\Models\Workout;
use App\Rules\ExistsForUserRule;
use App\Rules\TimeRule;
use App\Rules\WeekdaysRule;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

class RecurrenceUpdateRequest extends Data
{
    /**
     * @param  int[]  $weekdays
     */
    public function __construct(
        public Optional|string $name,

        #[Rule(new WeekdaysRule)]
        public Optional|array $weekdays,

        #[Rule(new TimeRule)]
        public Optional|string $time,

        #[Rule(new ExistsForUserRule(Workout::class))]
        public Optional|string $workoutId,
    ) {}
}
