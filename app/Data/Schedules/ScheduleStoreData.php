<?php

namespace App\Data\Schedules;

use App\Enums\ScheduleStatus;
use Spatie\LaravelData\Data;
use DateTimeInterface;

class ScheduleStoreData extends Data
{
    public function __construct(
        public ScheduleStatus $status,
        public int $workoutId,
        public int $recurrenceId,
        public DateTimeInterface $scheduledAt,
    ) {
    }
}
