<?php

namespace App\Data\Web\Schedules\Pages;

use App\Data\Shared\Schedules\ScheduleData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ScheduleShowProps extends Data
{
    public function __construct(public ScheduleData $schedule) {}
}
