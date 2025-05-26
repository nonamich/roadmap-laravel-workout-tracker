<?php

namespace App\Enums;

enum ScheduleStatus: string
{
    case Scheduled = 'scheduled';
    case Done = 'done';
    case Missed = 'missed';
}
