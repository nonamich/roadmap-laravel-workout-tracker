<?php

namespace App\Enums;

enum ScheduledWorkoutStatus: string
{
    case Scheduled = 'scheduled';
    case Done = 'done';
    case Missed = 'missed';
}
