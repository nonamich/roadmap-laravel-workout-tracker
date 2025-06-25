<?php

namespace App\Http\Controllers\Api;

use App\Data\Api\Workouts\Requests\WorkoutStoreApiData;
use App\Data\Api\Workouts\Requests\WorkoutUpdateApiData;
use App\Data\Shared\Requests\IndexQueryData;
use App\Http\Controllers\BaseController;
use App\Models\Workout;
use App\Services\PaginationService;
use Illuminate\Http\Resources\Json\JsonResource;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;

#[Authenticated]
#[Group('Workout')]
class WorkoutController extends BaseController
{
    public function __construct(private PaginationService $pagination)
    {
        $this->authorizeResource(Workout::class, 'workout');
        $this->middleware('auth:api');
    }

    #[ResponseFromApiResource(name: JsonResource::class, model: Workout::class, collection: true, simplePaginate: 10)]
    public function index(IndexQueryData $data): JsonResource
    {
        $query = Workout::query()
            ->where('user_id', '=', $this->getUserOrThrow()->id);

        return new JsonResource($this->pagination->paginate($query, $data));
    }

    #[ResponseFromApiResource(name: JsonResource::class, model: Workout::class)]
    public function store(WorkoutStoreApiData $data): JsonResource
    {
        return new JsonResource(
            Workout::create($data->toArray())
        );
    }

    #[ResponseFromApiResource(name: JsonResource::class, model: Workout::class)]
    public function show(Workout $workout): JsonResource
    {
        return new JsonResource($workout);
    }

    #[ResponseFromApiResource(name: JsonResource::class, model: Workout::class)]
    public function update(Workout $workout, WorkoutUpdateApiData $data): JsonResource
    {
        return new JsonResource(
            $workout->update($data->toArray())
        );
    }

    public function destroy(Workout $workout): void
    {
        $workout->delete();
    }
}
