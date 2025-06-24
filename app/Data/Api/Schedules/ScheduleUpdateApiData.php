<?php

namespace App\Data\Api\Schedules;

use App\Models\Workout;
use App\Rules\ExistsForUser;
use DateTime;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;

#[MergeValidationRules]
class ScheduleUpdateApiData extends Data
{
    public function __construct(
        #[Date]
        public Optional|DateTime $scheduledAt,

        #[Rule(new ExistsForUser(Workout::class))]
        public Optional|int $workoutId,
    ) {}
}
