<?php

namespace App\Data\Workouts;

use App\Models\Workout;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Filled;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use Illuminate\Support\Collection;

#[TypeScript]
class WorkoutStoreData extends Data
{
    public function __construct(
        public string $title,
        public ?string $description,

        #[Filled]
        /** @var Collection<int, WorkoutExercisesStoreData> */
        public Collection $exercises,

        #[Filled]
        /** @var Collection<int, WorkoutSchedulesStoreData> */
        public Collection $schedules
    ) {
    }

    public static function rules(ValidationContext $context): array
    {
        return [
            'title' => [
                Rule::unique(Workout::class, 'name')
                    ->where('user_id', auth()->id())
            ],
        ];
    }
}
