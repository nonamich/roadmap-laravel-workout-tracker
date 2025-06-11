<?php

namespace App\Data\Notifications;

use DateTimeInterface;
use Illuminate\Notifications\DatabaseNotification;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class NotificationData extends Data
{
    public function __construct(
        public string $id,
        public string $message,
        public string $link,
        public DateTimeInterface $createdAt,
        public ?DateTimeInterface $readAt,
    ) {
    }

    public static function fromModel(DatabaseNotification $notification)
    {
        return new self(
            id: $notification->id,
            readAt: $notification->read_at,
            message: $notification->data['message'],
            link: $notification->data['link'],
            createdAt: $notification->created_at,
        );
    }
}
