<?php

namespace App\Data\Workouts;

use App\Models\Workout;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Filled;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class WorkoutStoreData extends Data
{
    public function __construct(
        public string $title,
        public ?string $description,

        #[Filled, DataCollectionOf(WorkoutExercisesData::class)]
        /** @var array<WorkoutExercisesData> */
        public array $exercises,

        #[Filled, DataCollectionOf(WorkoutRecurrenceData::class)]
        /** @var array<WorkoutRecurrenceData> */
        public array $schedules
    ) {
    }

    public static function rules(ValidationContext $context): array
    {
        return [
            'title' => [
                Rule::unique(Workout::class, 'title')
                    ->where('user_id', auth()->id())
            ],
        ];
    }
}
