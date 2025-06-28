<?php

namespace App\Data\Web;

use App\Data\Shared\Schedules\ScheduleData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class DashboardPageWebData extends Data
{
    /**
     * @param  DataCollection<int, ScheduleData>  $schedules
     */
    public function __construct(
        #[DataCollectionOf(ScheduleData::class)]
        public DataCollection $schedules,
    ) {}
}
