<?php

namespace App\Data\Api\Schedules\Requests;

use App\Models\Workout;
use App\Rules\ExistsForUserRule;
use DateTime;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\After;
use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MergeValidationRules]
#[MapInputName(SnakeCaseMapper::class)]
class ScheduleStoreApiData extends Data
{
    public function __construct(
        #[Date, After('now')]
        public DateTime $scheduledAt,

        #[Rule(new ExistsForUserRule(Workout::class))]
        public int $workoutId,
    ) {}
}
