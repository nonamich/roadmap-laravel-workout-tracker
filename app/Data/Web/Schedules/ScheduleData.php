<?php

namespace App\Data\Web\Schedules;

use App\Data\Web\Recurrences\RecurrenceData;
use App\Data\Web\Workouts\WorkoutData;
use App\Enums\ScheduleStatus;
use App\Models\Schedule;
use App\Models\Workout;
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
        $workout = $schedule->workout()->first();
        $recurrence = $schedule->relationLoaded('recurrence') ? $schedule->recurrence()->first() : null;

        assert($workout instanceof Workout);

        return new self(
            id: $schedule->id,
            scheduled_at: $schedule->scheduled_at,
            status: $schedule->status,
            workout: WorkoutData::fromModel($workout),
            recurrence: $recurrence ? RecurrenceData::fromModel($recurrence) : null,
        );
    }
}
