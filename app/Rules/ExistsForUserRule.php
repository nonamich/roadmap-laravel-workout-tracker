<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\DatabaseRule;

class ExistsForUserRule implements ValidationRule
{
    use DatabaseRule {
        DatabaseRule::__construct as databaseRuleConstruct;
    }

    public function __construct(
        string $table,
        string $column = 'id',
        protected string $userColumn = 'user_id'
    ) {
        $this->databaseRuleConstruct($table, $column);
    }

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
