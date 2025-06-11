<?php

namespace App\Data\Recurrences\Store;

use App\Models\Recurrence;
use App\Rules\TimeRule;
use App\Rules\WeekdaysRule;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Attributes\Validation\Rule;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class RecurrenceStoreData extends Data
{
    public function __construct(
        #[Exists(Recurrence::class, 'id')]
        public ?int $id,

        public string $name,

        #[Rule(new WeekdaysRule)]
        /** @var int[] */
        public array $weekdays,

        #[Rule(new TimeRule)]
        public string $time,
    ) {}
}
