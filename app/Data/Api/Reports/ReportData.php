<?php

namespace App\Data\Api\Reports;

use App\Models\Schedule;
use DateTimeInterface;
use Spatie\LaravelData\Data;

class ReportData extends Data
{
    /**
     * @param  array<ReportExerciseData>  $exercises
     */
    public function __construct(
        public DateTimeInterface $scheduledAt,
        public array $exercises,
        public ReportWorkoutData $workout,
    ) {}

    public static function fromModel(Schedule $schedule): self
    {
        $workout = $schedule->workout();
        $workout2 = $schedule->workout;

        return new self(
            scheduledAt: $schedule->scheduled_at,
            workout: ReportWorkoutData::fromModel($workout),
            exercises: []
        );
    }
}
