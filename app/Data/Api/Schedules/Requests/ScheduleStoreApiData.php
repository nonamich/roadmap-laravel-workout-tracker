<?php

namespace App\Data\Api\Schedules\Requests;

use App\Models\Workout;
use App\Rules\ExistsForUser;
use DateTime;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\After;
use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

#[MergeValidationRules]
class ScheduleStoreApiData extends Data
{
    public function __construct(
        #[Date, After('now')]
        public DateTime $scheduledAt,

        #[Rule(new ExistsForUser(Workout::class))]
        public int $workoutId,
    ) {}
}
