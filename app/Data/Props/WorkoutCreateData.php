<?php

namespace App\Data\Props;

use App\Data\Recurrences\RecurrenceData;
use App\Data\Workouts\WorkoutData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class WorkoutCreateData extends Data
{
    public function __construct(
        public WorkoutData $workout,

        #[DataCollectionOf(WorkoutCreateExercisesData::class)]
        /** @var DataCollection<WorkoutCreateExercisesData> */
        public DataCollection $exercises,

        #[DataCollectionOf(RecurrenceData::class)]
        /** @var DataCollection<RecurrenceData> */
        public DataCollection $recurrences,
    ) {
    }
}
