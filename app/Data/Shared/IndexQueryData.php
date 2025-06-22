<?php

namespace App\Data\Shared;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\In;
use Spatie\LaravelData\Attributes\Validation\Max;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[MergeValidationRules]
#[MapName(SnakeCaseMapper::class)]
class IndexQueryData extends Data
{
    public function __construct(
        #[Min(1), Max(50)]
        public int $perPage,

        #[Min(1)]
        public int $page = 1,

        public string $sortBy = 'created_at',

        #[In(['asc', 'desc'])]
        public string $sortDir = 'desc',
    ) {}
}
