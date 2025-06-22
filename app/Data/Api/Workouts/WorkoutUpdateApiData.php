<?php

namespace App\Data\Api\Workouts;

use App\Models\Workout;
use App\Support\Utils;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Support\Validation\ValidationContext;

#[MergeValidationRules]
class WorkoutUpdateApiData extends Data
{
    public function __construct(
        public readonly Optional|string $name,
        public readonly Optional|string $category,
        public readonly Optional|string $description,
    ) {}

    /**
     * @return array<string, mixed>
     */
    public static function rules(ValidationContext $context): array
    {
        return [
            'name' => [
                Rule::unique(Workout::class, 'name')
                    ->where('user_id', auth()->id())
                    ->ignore(Utils::getModelFromRoute(Workout::class)?->id),
            ],
        ];
    }
}
