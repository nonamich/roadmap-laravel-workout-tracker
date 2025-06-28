<?php

namespace App\Http\Controllers\Api;

use App\Data\Api\Schedules\Requests\ScheduleStoreApiData;
use App\Data\Api\Schedules\Requests\ScheduleUpdateApiData;
use App\Data\Shared\Requests\IndexQueryData;
use App\Http\Controllers\BaseController;
use App\Models\Schedule;
use App\Services\PaginationService;
use Illuminate\Http\Resources\Json\JsonResource;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;

#[Authenticated]
#[Group('Schedule')]
class ScheduleResourceController extends BaseController
{
    public function __construct(private PaginationService $pagination)
    {
        $this->authorizeResource(Schedule::class, 'schedule');
        $this->middleware('auth:api');
    }

    #[ResponseFromApiResource(name: JsonResource::class, model: Schedule::class, collection: true, simplePaginate: 10)]
    public function index(IndexQueryData $data): JsonResource
    {
        $query = Schedule::query()
            ->where('user_id', '=', $this->getUserOrThrow()->id);

        return new JsonResource($this->pagination->paginate($query, $data));
    }

    #[ResponseFromApiResource(name: JsonResource::class, model: Schedule::class)]
    public function store(ScheduleStoreApiData $data): JsonResource
    {
        return new JsonResource(
            Schedule::create([
                'scheduled_at' => $data->scheduledAt,
                'workout_id' => $data->workoutId,
            ])
        );
    }

    #[ResponseFromApiResource(name: JsonResource::class, model: Schedule::class)]
    public function show(Schedule $schedule): JsonResource
    {
        return new JsonResource($schedule);
    }

    #[ResponseFromApiResource(name: JsonResource::class, model: Schedule::class)]
    public function update(Schedule $schedule, ScheduleUpdateApiData $data): JsonResource
    {
        $schedule->update([
            'status' => $data->status,
        ]);

        return new JsonResource($schedule);
    }

    public function destroy(Schedule $schedule): void
    {
        $schedule->delete();
    }
}
