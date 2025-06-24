<?php

namespace App\Data\Web\Schedules;

use App\Data\Web\Recurrences\RecurrenceWebData;
use App\Data\Web\Workouts\WorkoutWebData;
use App\Enums\ScheduleStatus;
use App\Models\Schedule;
use App\Models\Workout;
use DateTime;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ScheduleWebData extends Data
{
    public function __construct(
        public int $id,
        public DateTime $scheduledAt,
        public ScheduleStatus $status,
        public WorkoutWebData $workout,
        public ?RecurrenceWebData $recurrence,
    ) {}

    public static function fromModel(Schedule $schedule): self
    {
        $workout = $schedule->workout()->first();
        $recurrence = $schedule->relationLoaded('recurrence') ? $schedule->recurrence()->first() : null;

        assert($workout instanceof Workout);

        return new self(
            id: $schedule->id,
            scheduledAt: $schedule->scheduled_at,
            status: $schedule->status,
            workout: WorkoutWebData::fromModel($workout),
            recurrence: $recurrence ? RecurrenceWebData::fromModel($recurrence) : null,
        );
    }
}
