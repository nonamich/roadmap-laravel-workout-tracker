<?php

namespace App\Data\Web\Recurrences;

use App\Models\Recurrence;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class RecurrenceWebData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        /** @var int[] */
        public array $weekdays,
        public string $time,
    ) {}

    public static function fromModel(Recurrence $recurrence): self
    {
        return new self(
            id: $recurrence->id,
            name: $recurrence->name,
            weekdays: $recurrence->weekdays,
            time: $recurrence->time,
        );
    }
}
