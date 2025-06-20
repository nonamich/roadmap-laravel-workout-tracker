<?php

namespace App\Data\Shared\Exercises;

use App\Models\Exercise;
use App\Support\Utils;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Optional;
use Spatie\LaravelData\Support\Validation\ValidationContext;

#[MergeValidationRules]
class ExerciseUpdateData extends Data
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
                Rule::unique(Exercise::class, 'name')
                    ->where('user_id', auth()->id())
                    ->ignore(Utils::getModelFromRoute(Exercise::class)?->id),
            ],
        ];
    }
}
