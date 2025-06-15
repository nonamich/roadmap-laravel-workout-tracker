<?php

namespace App\Data\Notifications\Pages\Index;

use App\Data\Notifications\NotificationData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class NotificationIndexProps extends Data
{
    /**
     * @param  DataCollection<int, NotificationData>  $notifications
     */
    public function __construct(
        #[DataCollectionOf(NotificationData::class)]
        public DataCollection $notifications,
    ) {}
}
