<?php

use App\Jobs\ScheduleStatusJob;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new ScheduleStatusJob)
    ->everyMinute()
    ->withoutOverlapping();
