<?php

namespace App\Data\Props;

use App\Data\Exercises\ExerciseData;
use App\Data\Workouts\WorkoutData;
use App\Models\Exercise;
use App\Models\Workout;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Filled;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class WorkoutCreateExercisesData extends Data
{
    public function __construct(
        public ExerciseData $exercise,
        public int $sets,
        public int $reps,
    ) {
    }

    public static function fromModel(Exercise $exercise)
    {
        return new self(
            exercise: ExerciseData::fromModel($exercise),
            reps: $exercise->pivot->reps,
            sets: $exercise->pivot->sets,
        );
    }
}
