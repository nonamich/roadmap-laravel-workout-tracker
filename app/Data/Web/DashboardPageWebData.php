<?php

namespace App\Data\Web;

use App\Data\Web\Schedules\ScheduleWebData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class DashboardPageWebData extends Data
{
    /**
     * @param  DataCollection<int, ScheduleWebData>  $schedules
     */
    public function __construct(
        #[DataCollectionOf(ScheduleWebData::class)]
        public DataCollection $schedules,
    ) {}
}
