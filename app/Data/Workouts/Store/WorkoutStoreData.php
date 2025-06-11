<?php

namespace App\Data\Workouts\Store;

use App\Data\Recurrences\Store\RecurrenceStoreData;
use App\Models\Workout;
use App\Support\Utils;
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
        public ?int $id,
        public string $title,
        public ?string $description,

        #[Filled, DataCollectionOf(WorkoutStoreExercisesData::class)]
        /** @var array<WorkoutStoreExercisesData> */
        public array $exercises,

        #[Filled, DataCollectionOf(RecurrenceStoreData::class)]
        /** @var array<RecurrenceStoreData> */
        public array $recurrences
    ) {}

    public static function rules(ValidationContext $context): array
    {
        $workout = Utils::getModelFromRoute(Workout::class);
        $unique = Rule::unique(Workout::class, 'title')
            ->where('user_id', auth()->id());

        if ($workout) {
            $unique->ignore($workout->id);
        }

        return [
            'title' => [
                $unique,
            ],
        ];
    }
}
