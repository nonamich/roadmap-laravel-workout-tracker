<?php

namespace App\Data\Schedules\Pages;

use App\Data\Schedules\ScheduleData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ScheduleShowProps extends Data
{
    public function __construct(public ScheduleData $schedule) {}
}
