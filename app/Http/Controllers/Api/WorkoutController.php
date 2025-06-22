<?php

namespace App\Http\Controllers\Api;

use App\Data\Shared\Exercises\ExerciseStoreData;
use App\Data\Shared\Exercises\ExerciseUpdateData;
use App\Data\Shared\IndexQueryData;
use App\Http\Controllers\BaseController;
use App\Models\Exercise;
use App\Services\PaginationService;
use Illuminate\Http\Resources\Json\JsonResource;
use Knuckles\Scribe\Attributes\Authenticated;
use Knuckles\Scribe\Attributes\Group;
use Knuckles\Scribe\Attributes\ResponseFromApiResource;

#[Authenticated]
#[Group('Workouts')]
class WorkoutController extends BaseController
{
    public function __construct(private PaginationService $pagination)
    {
        $this->authorizeResource(Exercise::class, 'workout');
        $this->middleware('auth:api');
    }

    #[ResponseFromApiResource(name: JsonResource::class, model: Exercise::class, collection: true, simplePaginate: 10)]
    public function index(IndexQueryData $data): JsonResource
    {
        $query = Exercise::query()
            ->where('user_id', '=', $this->getUserOrThrow()->id);

        return new JsonResource($this->pagination->paginate($query, $data));
    }

    #[ResponseFromApiResource(name: JsonResource::class, model: Exercise::class)]
    public function store(ExerciseStoreData $data): JsonResource
    {
        return new JsonResource(
            Exercise::create($data->toArray())
        );
    }

    #[ResponseFromApiResource(name: JsonResource::class, model: Exercise::class)]
    public function show(Exercise $exercise): JsonResource
    {
        return new JsonResource($exercise);
    }

    #[ResponseFromApiResource(name: JsonResource::class, model: Exercise::class)]
    public function update(Exercise $exercise, ExerciseUpdateData $data): JsonResource
    {
        return new JsonResource(
            $exercise->update($data->toArray())
        );
    }

    public function destroy(Exercise $exercise): void
    {
        $exercise->delete();
    }
}
