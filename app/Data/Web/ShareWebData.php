<?php

namespace App\Data\Web;

use App\Data\Web\Notifications\NotificationWebData;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class ShareWebData extends Data
{
    /**
     * @param  DataCollection<int, NotificationWebData>  $notifications
     */
    public function __construct(
        public ?UserShareWebData $user,

        #[DataCollectionOf(NotificationWebData::class)]
        public DataCollection $notifications,

        public FlashMessageWebData|string|null $flash,
    ) {}
}
