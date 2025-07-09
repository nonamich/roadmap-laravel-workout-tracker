<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\DatabaseRule;

class UniqueForUserRule implements ValidationRule
{
    use DatabaseRule {
        DatabaseRule::__construct as databaseRuleConstruct;
    }

    public function __construct(
        string $table,
        string $column = 'id',
        protected string $userColumn = 'user_id',
        protected ?int $ignoreId = null,
        protected string $ignoreColumn = 'id'
    ) {
        $this->databaseRuleConstruct($table, $column);
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $query = DB::table($this->table)
            ->where($this->column, $value)
            ->where($this->userColumn, Auth::id());

        if ($this->ignoreId !== null) {
            $query->where($this->ignoreColumn, '!=', $this->ignoreId);
        }

        if ($query->exists()) {
            $fail("The {$attribute} has already been taken.");
        }
    }
}
