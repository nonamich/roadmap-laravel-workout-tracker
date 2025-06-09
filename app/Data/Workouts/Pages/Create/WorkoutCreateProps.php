<?php

namespace App\Data\Workouts\Pages\Create;

use App\Data\Exercises\ExerciseData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class WorkoutCreateProps extends Data
{
    public function __construct(
        #[DataCollectionOf(ExerciseData::class)]
        /** @var DataCollection<ExerciseData> */
        public DataCollection $exercises,
    ) {
    }
}
