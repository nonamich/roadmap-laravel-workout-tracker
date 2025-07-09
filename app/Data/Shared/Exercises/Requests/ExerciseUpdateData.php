<?php

namespace App\Data\Shared\Exercises\Requests;

use App\Models\Exercise;
use App\Rules\UniqueForUserRule;
use App\Support\Utils;
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
    public static function rules(?ValidationContext $context = null): array
    {
        return [
            'name' => [
                new UniqueForUserRule(
                    table: Exercise::class,
                    column: 'name',
                    ignoreId: Utils::getModelFromRoute(Exercise::class)?->id
                ),
            ],
        ];
    }
}
