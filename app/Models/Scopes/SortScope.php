<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SortScope implements Scope
{
    public function __construct(
        private ?string $sortBy = null,
        private ?string $sortDir = null,
        private ?array $allowedBy = ['created_at']
    ) {}

    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $sortBy = $this->sortBy ?: request()->get('sort_by');
        $sortDir = $this->sortDir ?: request()->get('sort_dir');

        if (! in_array($sortBy, $this->allowedBy)) {
            $sortBy = 'created_at';
        }

        if (! in_array($sortDir, ['asc', 'desc'])) {
            $sortDir = 'desc';
        }

        $builder->orderBy($sortBy, $sortDir);
    }
}
