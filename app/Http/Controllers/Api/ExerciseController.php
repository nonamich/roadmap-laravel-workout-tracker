<?php

namespace App\Http\Controllers\Api;

use App\Data\Shared\Exercises\ExerciseQueryData;
use App\Data\Shared\Exercises\ExerciseStoreData;
use App\Data\Shared\Exercises\ExerciseUpdateData;
use App\Http\Controllers\BaseController;
use App\Models\Exercise;
use App\Services\ExerciseService;
use Illuminate\Http\Resources\Json\JsonResource;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;
use Knuckles\Scribe\Attributes\Subgroup;

#[Authenticated]
#[Subgroup('Exercise')]
class ExerciseController extends BaseController
{
    public function __construct(private ExerciseService $service) {}

    #[Authenticated]
    #[ResponseFromApiResource(name: JsonResource::class, model: Exercise::class, collection: true, simplePaginate: 10)]
    public function index(ExerciseQueryData $dto): JsonResource
    {
        $user = request()->user();

        if (! $user) {
            abort(401);
        }

        return new JsonResource($this->service->getPaginatedAndSorted($dto, $user));
    }

    #[ResponseFromApiResource(name: JsonResource::class, model: Exercise::class)]
    public function store(ExerciseStoreData $dto): JsonResource
    {
        $user = request()->user();

        if (! $user) {
            abort(401);
        }

        return new JsonResource($this->service->storeExercise($dto, $user));
    }

    #[ResponseFromApiResource(name: JsonResource::class, model: Exercise::class)]
    public function show(Exercise $exercise): JsonResource
    {
        return new JsonResource($exercise);
    }

    #[ResponseFromApiResource(name: JsonResource::class, model: Exercise::class)]
    public function update(Exercise $exercise, ExerciseUpdateData $data): JsonResource
    {
        $this->authorize('update', $exercise);

        return new JsonResource($this->service->updateExercise($exercise, $data));
    }

    public function destroy(Exercise $exercise): void
    {
        $this->authorize('delete', $exercise);

        $this->service->destroyExercise($exercise);
    }
}
