<?php

namespace App\Data\Workouts\Pages\Edit;

use App\Data\Exercises\ExerciseData;
use App\Data\Recurrences\RecurrenceData;
use App\Data\Workouts\WorkoutData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class WorkoutEditProps extends Data
{
    public function __construct(
        public WorkoutData $workout,

        #[DataCollectionOf(WorkoutEditExercisesProps::class)]
        /** @var DataCollection<WorkoutCreateExercisesData> */
        public DataCollection $workoutExercises,

        #[DataCollectionOf(ExerciseData::class)]
        /** @var DataCollection<ExerciseData> */
        public DataCollection $exercises,

        #[DataCollectionOf(RecurrenceData::class)]
        /** @var DataCollection<RecurrenceData> */
        public DataCollection $recurrences,
    ) {}
}
