<?php

namespace App\Data\Api\Schedules;

use App\Models\Workout;
use DateTime;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\Attributes\MergeValidationRules;
use Spatie\LaravelData\Attributes\Validation\Date;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Support\Validation\ValidationContext;

#[MergeValidationRules]
class ScheduleStoreApiData extends Data
{
    public function __construct(
        #[Date]
        public DateTime $scheduledAt,
        public int $workoutId,
    ) {}

    /**
     * @return array<string, mixed>
     */
    public static function rules(ValidationContext $context): array
    {
        return [
            'workoutId' => [
                Rule::exists(Workout::class, 'id')
                    ->where('user_id', auth()->id()),
            ],
        ];
    }
}
