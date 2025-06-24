<?php

namespace App\Data\Web\Workouts\Pages;

use App\Data\Web\Exercises\ExerciseWebData;
use App\Data\Web\Recurrences\RecurrenceWebData;
use App\Data\Web\Workouts\WorkoutWebData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class WorkoutEditProps extends Data
{
    /**
     * @param  DataCollection<int, WorkoutEditExercisesProps>  $workoutExercises
     * @param  DataCollection<int, ExerciseWebData>  $exercises
     * @param  DataCollection<int, RecurrenceWebData>  $recurrences
     */
    public function __construct(
        public WorkoutWebData $workout,

        #[DataCollectionOf(WorkoutEditExercisesProps::class)]
        public DataCollection $workoutExercises,

        #[DataCollectionOf(ExerciseWebData::class)]
        public DataCollection $exercises,

        #[DataCollectionOf(RecurrenceWebData::class)]
        public DataCollection $recurrences,
    ) {}
}
