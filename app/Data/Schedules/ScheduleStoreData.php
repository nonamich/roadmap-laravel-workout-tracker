<?php

namespace App\Data\Schedules;

use App\Enums\ScheduleStatus;
use DateTimeInterface;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ScheduleStoreData extends Data
{
    public function __construct(
        public ScheduleStatus $status,
        public int $workoutId,
        public int $recurrenceId,
        public int $userId,
        public DateTimeInterface $scheduledAt,
    ) {}
}
