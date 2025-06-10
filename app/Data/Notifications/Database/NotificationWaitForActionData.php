<?php

namespace App\Data\Notifications\Database;

use DateTimeInterface;
use Spatie\LaravelData\Data;

class NotificationWaitForActionData extends Data
{
    public function __construct(
        public string $scheduleId,
    ) {
    }
}
