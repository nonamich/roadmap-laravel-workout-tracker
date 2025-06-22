<?php

namespace App\Services;

use App\Data\Shared\IndexQueryData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;

class PaginationService
{
    /**
     * @template T of Model
     *
     * @param  Builder<T>  $query
     * @return Paginator<int, T>
     */
    public function paginate(Builder $query, IndexQueryData $dto): Paginator
    {
        return $query
            ->orderBy($dto->sortBy, $dto->sortDir)
            ->simplePaginate(
                page: $dto->page,
                perPage: $dto->perPage,
            )
            ->withQueryString();
    }
}
