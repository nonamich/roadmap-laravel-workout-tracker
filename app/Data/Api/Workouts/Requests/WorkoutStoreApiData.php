<?php

namespace App\Data\Api\Workouts\Requests;

use App\Models\Workout;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

#[MergeValidationRules]
class WorkoutStoreApiData extends Data
{
    public function __construct(
        public readonly string $title,
        public readonly string $category,
        public readonly ?string $description,
    ) {}

    /**
     * @return array<string, mixed>
     */
    public static function rules(?ValidationContext $context = null): array
    {
        return [
            'title' => [
                Rule::unique(Workout::class, 'title')
                    ->where('user_id', auth()->id()),
            ],
        ];
    }
}
