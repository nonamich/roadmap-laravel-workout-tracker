<?php

namespace App\Data\Notifications\Pages\Index;

use App\Data\Notifications\NotificationData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class NotificationIndexProps extends Data
{
    public function __construct(
        #[DataCollectionOf(NotificationWaitForActionData::class)]
        /** @var DataCollection<NotificationData> */
        public DataCollection $notifications,
    ) {}
}
