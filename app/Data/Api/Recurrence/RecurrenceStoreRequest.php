<?php

namespace App\Data\Api\Recurrence;

use App\Models\Workout;
use App\Rules\ExistsForUser;
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

        #[Rule(new ExistsForUser(Workout::class))]
        public string $workoutId,
    ) {}
}
