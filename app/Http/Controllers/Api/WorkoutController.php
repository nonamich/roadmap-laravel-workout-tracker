<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\Exercise;
use App\Services\ExerciseService;
use Illuminate\Http\Resources\Json\JsonResource;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;
use Knuckles\Scribe\Attributes\Subgroup;

#[Authenticated]
#[Subgroup('Exercises')]
class WorkoutController extends BaseController
{
    public function __construct(private ExerciseService $service)
    {
        $this->authorizeResource(Exercise::class, 'exercise');
        $this->middleware('auth:api');
    }

    #[Authenticated]
    #[ResponseFromApiResource(name: JsonResource::class, model: Exercise::class, collection: true, simplePaginate: 10)]
    public function index(WorkoutQueryData $dto): JsonResource
    {
        return new JsonResource($this->service->getPaginatedAndSorted($dto, $this->getUserOrThrow()));
    }

    #[ResponseFromApiResource(name: JsonResource::class, model: Exercise::class)]
    public function store(WorkoutStoreData $dto): JsonResource
    {
        return new JsonResource($this->service->storeExercise($dto, $this->getUserOrThrow()));
    }

    #[ResponseFromApiResource(name: JsonResource::class, model: Exercise::class)]
    public function show(Exercise $exercise): JsonResource
    {
        return new JsonResource($exercise);
    }

    #[ResponseFromApiResource(name: JsonResource::class, model: Exercise::class)]
    public function update(Exercise $exercise, WorkoutUpdateData $data): JsonResource
    {
        return new JsonResource($this->service->updateExercise($exercise, $data));
    }

    public function destroy(Exercise $exercise): void
    {
        $this->service->destroyExercise($exercise);
    }
}
