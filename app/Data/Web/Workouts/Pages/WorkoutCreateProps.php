<?php

namespace App\Data\Web\Workouts\Pages;

use App\Data\Web\Exercises\ExerciseWebData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class WorkoutCreateProps extends Data
{
    /**
     * @param  DataCollection<int, ExerciseWebData>  $exercises
     */
    public function __construct(
        #[DataCollectionOf(ExerciseWebData::class)]
        public DataCollection $exercises,
    ) {}
}
