<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class ExistsForUser implements ValidationRule
{
    public function __construct(
        protected string $table,
        protected string $column = 'id',
        protected string $userColumn = 'user_id'
    ) {}

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $userId = auth()->id();

        $exists = DB::table($this->table)
            ->where($this->column, $value)
            ->where($this->userColumn, $userId)
            ->exists();

        if (! $exists) {
            $fail("The selected {$attribute} is invalid or does not belong to you.");
        }
    }
}
