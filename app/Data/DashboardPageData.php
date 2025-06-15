<?php

namespace App\Data;

use App\Data\Schedules\ScheduleData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class DashboardPageData extends Data
{
    /**
     * @param  DataCollection<int, ScheduleData>  $schedules
     */
    public function __construct(
        #[DataCollectionOf(ScheduleData::class)]
        public DataCollection $schedules,
    ) {}
}
