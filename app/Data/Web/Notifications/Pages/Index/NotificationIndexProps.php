<?php

namespace App\Data\Web\Notifications\Pages\Index;

use App\Data\Web\Notifications\NotificationWebData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;

class NotificationIndexProps extends Data
{
    /**
     * @param  DataCollection<int, NotificationWebData>  $notifications
     */
    public function __construct(
        #[DataCollectionOf(NotificationWebData::class)]
        public DataCollection $notifications,
    ) {}
}
