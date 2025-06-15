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

    public static function authorize(): bool
    {
        $user = auth()->user();
        $exercise = Utils::getModelFromRoute(Exercise::class);

        return $user !== null
            && $exercise !== null
            && $user->id === $exercise->user_id;
    }
}
