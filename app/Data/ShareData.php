<?php

namespace App\Data;

use App\Data\Notifications\NotificationData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ShareData extends Data
{
    /**
     * @param  DataCollection<int, NotificationData>  $notifications
     */
    public function __construct(
        public ?UserShareData $user,

        #[DataCollectionOf(NotificationData::class)]
        public DataCollection $notifications,

        public FlashMessageData|string|null $flash,
    ) {}
}
