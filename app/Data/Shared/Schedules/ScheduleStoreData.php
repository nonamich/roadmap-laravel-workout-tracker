<?php

namespace App\Data\Shared\Schedules;

use App\Models\Exercise;
use App\Models\Recurrence;
use App\Rules\ExistsForUser;
use DateTimeInterface;
use Spatie\LaravelData\Attributes\Validation\After;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

class ScheduleStoreData extends Data
{
    public function __construct(
        #[Rule(new ExistsForUser(Exercise::class))]

        public int $workoutId,

        #[Rule(new ExistsForUser(Recurrence::class))]
        public int $recurrenceId,

        #[After('now')]
        public DateTimeInterface $scheduledAt,
    ) {}
}
