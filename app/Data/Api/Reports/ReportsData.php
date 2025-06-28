<?php

namespace App\Data\Api\Reports;

use DateTimeImmutable;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

class ReportsData extends Data
{
    /**
     * @param  Collection<int, ReportData>  $data
     */
    public function __construct(
        public DateTimeImmutable $startTime,
        public DateTimeImmutable $endTime,
        public Collection $data,
    ) {}
}
