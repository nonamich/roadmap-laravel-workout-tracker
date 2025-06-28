<?php

namespace App\Data\Web\Workouts\Pages;

use App\Data\Shared\Exercises\ExerciseData;
use App\Data\Shared\Workouts\WorkoutData;
use App\Data\Web\Recurrences\RecurrenceWebData;
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
     * @param  DataCollection<int, RecurrenceWebData>  $recurrences
     */
    public function __construct(
        public WorkoutData $workout,

        #[DataCollectionOf(WorkoutEditExercisesProps::class)]
        public DataCollection $workoutExercises,

        #[DataCollectionOf(ExerciseData::class)]
        public DataCollection $exercises,

        #[DataCollectionOf(RecurrenceWebData::class)]
        public DataCollection $recurrences,
    ) {}
}
