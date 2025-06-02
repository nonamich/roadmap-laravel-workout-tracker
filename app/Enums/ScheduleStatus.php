<?php

namespace App\Enums;

use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
enum ScheduleStatus: string
{
    case Scheduled = 'scheduled';
    case Done = 'done';
    case WaitForAction = 'wait-for-action';
    case Missed = 'missed';
}
