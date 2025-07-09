<?php

namespace App\Data\Api\Workouts\Requests;

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
        public readonly Optional|string $title,
        public readonly Optional|string $category,
        public readonly Optional|string $description,
    ) {}

    /**
     * @return array<string, mixed>
     */
    public static function rules(?ValidationContext $context = null): array
    {
        return [
            'title' => [
                Rule::unique(Workout::class, 'title')
                    ->where('user_id', auth()->id())
                    ->ignore(Utils::getModelFromRoute(Workout::class)?->id),
            ],
        ];
    }
}
