<?php

namespace App\Data\Workouts\Pages;

use App\Data\Exercises\ExerciseData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class WorkoutCreateProps extends Data
{
    /**
     * @param  DataCollection<int, ExerciseData>  $exercises
     */
    public function __construct(
        #[DataCollectionOf(ExerciseData::class)]
        public DataCollection $exercises,
    ) {}
}
