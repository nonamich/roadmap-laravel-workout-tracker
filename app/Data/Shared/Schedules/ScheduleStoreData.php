<?php

namespace App\Data\Shared\Schedules;

use DateTimeInterface;
use Spatie\LaravelData\Data;

class ScheduleStoreData extends Data
{
    public function __construct(
        public int $workoutId,
        public int $recurrenceId,
        public DateTimeInterface $scheduledAt,
    ) {}
}
