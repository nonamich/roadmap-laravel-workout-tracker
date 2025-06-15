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
    /**
     * @param  DataCollection<int, WorkoutEditExercisesProps>  $workoutExercises
     * @param  DataCollection<int, ExerciseData>  $exercises
     * @param  DataCollection<int, RecurrenceData>  $recurrences
     */
    public function __construct(
        public WorkoutData $workout,

        #[DataCollectionOf(WorkoutEditExercisesProps::class)]
        public DataCollection $workoutExercises,

        #[DataCollectionOf(ExerciseData::class)]
        public DataCollection $exercises,

        #[DataCollectionOf(RecurrenceData::class)]
        public DataCollection $recurrences,
    ) {}
}
