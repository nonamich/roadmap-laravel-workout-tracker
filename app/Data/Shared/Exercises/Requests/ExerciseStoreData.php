<?php

namespace App\Data\Shared\Exercises\Requests;

use App\Models\Exercise;
use App\Rules\UniqueForUser;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;

#[MergeValidationRules]
class ExerciseStoreData extends Data
{
    public function __construct(
        #[Rule(new UniqueForUser(Exercise::class, 'name'))]
        public readonly string $name,

        public readonly string $category,
        public readonly ?string $description,
    ) {}
}
