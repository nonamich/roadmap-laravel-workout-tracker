<?php

namespace App\Data\Api\Reports;

use App\Models\Schedule;
use App\Models\Workout;
use DateTimeInterface;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class ReportData extends Data
{
    /**
     * @param  Collection<int, ReportExerciseData>  $exercises
     */
    public function __construct(
        public DateTimeInterface $scheduledAt,
        public ReportWorkoutData $workout,
        public Collection $exercises,
    ) {}

    public static function fromModel(Schedule $schedule): self
    {
        $workout = $schedule->workout;

        assert($workout instanceof Workout);

        return new self(
            scheduledAt: $schedule->scheduled_at,
            workout: ReportWorkoutData::fromModel($workout),
            exercises: ReportExerciseData::collect($workout->exercises)
        );
    }
}
