<?php

namespace App\Data\Shared\Exercises;

use App\Models\Exercise;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

#[MergeValidationRules]
class ExerciseStoreData extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $category,
        public readonly ?string $description,
    ) {}

    /**
     * @return array<string, mixed>
     */
    public static function rules(ValidationContext $context): array
    {
        return [
            'name' => [
                Rule::unique(Exercise::class, 'name')
                    ->where('user_id', auth()->id()),
            ],
        ];
    }
}
