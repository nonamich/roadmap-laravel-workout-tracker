<?php

namespace App\Http\Controllers\Api;

use App\Data\Api\Recurrence\RecurrenceStoreRequest;
use App\Data\Api\Recurrence\RecurrenceUpdateRequest;
use App\Data\Shared\Requests\IndexQueryData;
use App\Http\Controllers\BaseController;
use App\Models\Recurrence;
use App\Services\PaginationService;
use Illuminate\Http\Resources\Json\JsonResource;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;

#[Authenticated]
#[Group('Recurrence')]
class RecurrenceResourceController extends BaseController
{
    public function __construct(private PaginationService $pagination)
    {
        $this->authorizeResource(Recurrence::class, 'Recurrence');
        $this->middleware('auth:api');
    }

    #[ResponseFromApiResource(name: JsonResource::class, model: Recurrence::class, collection: true, simplePaginate: 10)]
    public function index(IndexQueryData $data): JsonResource
    {
        $query = Recurrence::query()
            ->where('user_id', '=', $this->getUserOrThrow()->id);

        return new JsonResource($this->pagination->paginate($query, $data));
    }

    #[ResponseFromApiResource(name: JsonResource::class, model: Recurrence::class)]
    public function store(RecurrenceStoreRequest $data): JsonResource
    {
        return new JsonResource(
            Recurrence::create([
                'name' => $data->name,
                'time' => $data->time,
                'weekdays' => $data->weekdays,
                'workout_id' => $data->workoutId,
                'user_id' => $this->getUserOrThrow()->id,
            ])
        );
    }

    #[ResponseFromApiResource(name: JsonResource::class, model: Recurrence::class)]
    public function show(Recurrence $recurrence): JsonResource
    {
        return new JsonResource($recurrence);
    }

    #[ResponseFromApiResource(name: JsonResource::class, model: Recurrence::class)]
    public function update(Recurrence $recurrence, RecurrenceUpdateRequest $data): JsonResource
    {
        $recurrence->update([
            'name' => $data->name,
            'time' => $data->time,
            'weekdays' => $data->weekdays,
            'workout_id' => $data->workoutId,
        ]);

        return new JsonResource($recurrence);
    }

    public function destroy(Recurrence $recurrence): void
    {
        $recurrence->delete();
    }
}
