<?php

namespace App\Data\Web\Workouts\Requests;

use App\Data\Web\Recurrences\Requests\RecurrenceStoreWebData;
use App\Models\Workout;
use App\Rules\UniqueForUserRule;
use App\Support\Utils;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Filled;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[MergeValidationRules]
class WorkoutStoreWebData extends Data
{
    /**
     * @param  array<WorkoutStoreExercisesWebData>  $exercises
     * @param  array<RecurrenceStoreWebData>  $recurrences
     */
    public function __construct(
        public ?int $id,
        public string $title,
        public ?string $description,

        #[Filled, DataCollectionOf(WorkoutStoreExercisesWebData::class)]
        public array $exercises,

        #[Filled, DataCollectionOf(RecurrenceStoreWebData::class)]
        public array $recurrences
    ) {}

    /**
     * @return array<string, mixed>
     */
    public static function rules(?ValidationContext $context = null): array
    {
        return [
            'title' => [
                new UniqueForUserRule(
                    Workout::class,
                    'title',
                    ignoreId: Utils::getModelFromRoute(Workout::class)?->id
                ),
            ],
        ];
    }
}
