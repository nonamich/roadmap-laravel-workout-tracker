<?php

namespace App\Services;

use App\Data\Web\Recurrences\Requests\RecurrenceStoreWebData;
use App\Models\Recurrence;
use App\Models\Workout;

class RecurrenceWebService
{
    public function __construct(private ScheduleWebService $scheduleWebService) {}

    /**
     * @param  array<RecurrenceStoreWebData>  $recurrencesDto
     */
    public function createOrUpdate(Workout $workout, array $recurrencesDto): void
    {
        $recurrencesDto = collect($recurrencesDto);
        $recurrencesDtoWithId = $recurrencesDto->filter(fn ($dto) => (bool) $dto->id);
        $recurrencesDtoWithoutId = $recurrencesDto->filter(fn ($dto) => ! $dto->id);
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
                    fn ($dto) => [
                        'name' => $dto->name,
                        'time' => $dto->time,
                        'weekdays' => $dto->weekdays,
                        'user_id' => $workout->user_id,
                    ]
                )
            );

        foreach ($recurrencesDtoWithId as $dto) {
            $recurrence = $recurrences->firstWhere('id', $dto->id);

            if (! ($recurrence instanceof Recurrence)) {
                continue;
            }

            $recurrence->update([
                'name' => $dto->name,
                'time' => $dto->time,
                'weekdays' => $dto->weekdays,
            ]);
        }

        $this->scheduleWebService->createSchedulesByWorkout($workout);
    }
}
