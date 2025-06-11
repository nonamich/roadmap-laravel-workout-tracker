<?php

namespace App\Data\Schedules;

use App\Data\Recurrences\RecurrenceData;
use App\Data\Workouts\WorkoutData;
use App\Enums\ScheduleStatus;
use App\Models\Schedule;
use DateTime;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ScheduleData extends Data
{
    public function __construct(
        public int $id,
        public DateTime $scheduled_at,
        public ScheduleStatus $status,
        public WorkoutData $workout,
        public ?RecurrenceData $recurrence,
    ) {}

    public static function fromModel(Schedule $schedule): self
    {
        return new self(
            id: $schedule->id,
            scheduled_at: $schedule->scheduled_at,
            status: $schedule->status,
            workout: WorkoutData::fromModel($schedule->workout),
            recurrence: $schedule->relationLoaded('recurrence') ? RecurrenceData::fromModel($schedule->recurrence) : null,
        );
    }
}
