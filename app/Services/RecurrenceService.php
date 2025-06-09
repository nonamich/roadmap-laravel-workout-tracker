<?php

namespace App\Services;

use App\Data\Recurrences\Store\RecurrenceStoreData;
use App\Models\Workout;
use App\Models\Recurrence;
use Illuminate\Support\Collection;

class RecurrenceService
{
    public function __construct(private ScheduleService $scheduleService)
    {
    }

    /**
     * @param array<RecurrenceStoreData> $recurrencesDto
     */
    public function createOrUpdate(Workout $workout, array $recurrencesDto)
    {
        $recurrencesDto = collect($recurrencesDto);
        $recurrencesDtoWithId = $recurrencesDto->filter(fn($dto) => !!$dto->id);
        $recurrencesDtoWithoutId = $recurrencesDto->filter(fn($dto) => !$dto->id);
        $selectedRecurrencesIds = $recurrencesDtoWithId->pluck('id');
        $recurrences = $workout->recurrences()->get();


        foreach ($recurrences as $recurrence) {
            if ($selectedRecurrencesIds->contains($recurrence->id)) {
                continue;
            }

            $recurrence->delete();
        }

        $workout->recurrences()
            ->createMany(
                $recurrencesDtoWithoutId->map(
                    fn($dto) => [
                        'name' => $dto->name,
                        'time' => $dto->time,
                        'weekdays' => $dto->weekdays,
                    ]
                )->toArray()
            );

        foreach ($recurrencesDtoWithId as $dto) {
            $recurrence = $recurrences->firstWhere('id', $dto->id);

            if (!($recurrence instanceof Recurrence)) {
                continue;
            }

            $recurrence->update([
                'name' => $dto->name,
                'time' => $dto->time,
                'weekdays' => $dto->weekdays,
            ]);
        }

        $this->scheduleService->createSchedulesByWorkout($workout);
    }
}
