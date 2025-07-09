<?php

namespace App\Data\Api\Schedules\Requests;

use App\Enums\ScheduleStatus;
use Spatie\LaravelData\Attributes\Validation\In;
use Spatie\LaravelData\Data;

class ScheduleUpdateApiData extends Data
{
    public function __construct(
        #[In([ScheduleStatus::Done->value, ScheduleStatus::Missed->value])]
        public ScheduleStatus $status,
    ) {}
}
