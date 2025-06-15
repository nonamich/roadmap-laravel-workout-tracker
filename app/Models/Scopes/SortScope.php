<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SortScope implements Scope
{
    /**
     * @param  list<non-empty-string>  $allowedBy
     */
    public function __construct(
        private ?string $sortBy = null,
        private ?string $sortDir = null,
        private array $allowedBy = ['created_at']
    ) {}

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  Builder<Model>  $builder
     */
    public function apply(Builder $builder, Model $model): void
    {
        $sortBy = $this->sortBy ?: request()->get('sort_by');
        $sortDir = $this->sortDir ?: request()->get('sort_dir');

        if (! is_string($sortBy) || ! in_array($sortBy, $this->allowedBy)) {
            $sortBy = 'created_at';
        }

        if (! is_string($sortDir) || ! in_array($sortDir, ['asc', 'desc'])) {
            $sortDir = 'desc';
        }

        $builder->orderBy($sortBy, $sortDir);
    }
}
