<?php

namespace App\Data\Api\Reports;

use DateTimeImmutable;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\After;
use Spatie\LaravelData\Attributes\Validation\DateFormat;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Attributes\WithTransformer;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Transformers\DateTimeInterfaceTransformer;

#[MapName(SnakeCaseMapper::class)]
class ReportRequestData extends Data
{
    public const string DATE_FORMAT = 'Y-m-d';

    public function __construct(
        #[WithCast(DateTimeInterfaceCast::class, self::DATE_FORMAT)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, self::DATE_FORMAT)]
        #[DateFormat(format: self::DATE_FORMAT)]
        public DateTimeImmutable $startTime,

        #[WithCast(DateTimeInterfaceCast::class, self::DATE_FORMAT)]
        #[WithTransformer(DateTimeInterfaceTransformer::class, self::DATE_FORMAT)]
        #[DateFormat(format: self::DATE_FORMAT), After('start_time')]
        public DateTimeImmutable $endTime,
    ) {}
}
