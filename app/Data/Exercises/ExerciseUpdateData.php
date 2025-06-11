<?php

namespace App\Data\Exercises;

use App\Models\Exercise;
use App\Support\Utils;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

class ExerciseUpdateData extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $category,
        public readonly ?string $description,
    ) {
    }

    public static function rules(ValidationContext $context): array
    {
        return [
            'name' => [
                Rule::unique(Exercise::class, 'name')
                    ->where('user_id', auth()->id())
                    ->ignore(Utils::getModelFromRoute(Exercise::class)?->id ?? null),
            ],
        ];
    }

    public static function authorize(): bool
    {
        $exercise = Utils::getModelFromRoute(Exercise::class);

        return auth()->user()->id === $exercise->user_id;
    }
}
