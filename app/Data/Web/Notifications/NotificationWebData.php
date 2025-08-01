<?php

namespace App\Data\Web\Notifications;

use DateTimeInterface;
use Illuminate\Notifications\DatabaseNotification;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class NotificationWebData extends Data
{
    public function __construct(
        public string $id,
        public string $message,
        public string $link,
        public DateTimeInterface $createdAt,
        public ?DateTimeInterface $readAt,
    ) {}

    public static function fromModel(DatabaseNotification $notification): NotificationWebData
    {
        return new self(
            id: $notification->id,
            readAt: $notification->read_at,
            message: $notification->data['message'],
            link: $notification->data['link'],
            createdAt: $notification->created_at instanceof DateTimeInterface ? $notification->created_at : new \DateTime,
        );
    }
}
