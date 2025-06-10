<?php

namespace App\Data\Notifications;

use App\Models\Notification;
use DateTimeInterface;
use Spatie\LaravelData\Data;

class NotificationData extends Data
{
    public function __construct(
        public string $id,
        public string $message,
        public ?DateTimeInterface $readAt,
    ) {
    }

    public static function fromModel(Notification $notification)
    {
        return new self(
            id: $notification->id,
            readAt: $notification->read_at,
            message: $notification->message,
        );
    }
}
