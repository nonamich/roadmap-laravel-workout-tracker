<?php

namespace App\Http\Controllers\Web;

use App\Data\Exercises\ExerciseData;
use App\Data\Exercises\ExerciseStoreData;
use App\Data\Exercises\ExerciseUpdateData;
use App\Data\Exercises\Pages\Edit\ExerciseEditProps;
use App\Data\FlashMessageData;
use App\Enums\FlashComponent;
use App\Http\Controllers\BaseController;
use App\Models\Exercise;
use App\Models\Scopes\SortScope;
use App\Services\ExerciseService;
use Inertia\Inertia;
use Spatie\LaravelData\PaginatedDataCollection;

class ExerciseController extends BaseController
{
    public function __construct(private ExerciseService $exerciseService) {}

    public function index()
    {
        $exercises = auth()->user()
            ->exercises()
            ->withGlobalScope(
                'sort',
                new SortScope(allowedBy: ['created_at', 'name'])
            )
            ->paginate(5)
            ->withQueryString();
        $props = ExerciseData::collect($exercises, PaginatedDataCollection::class);

        return Inertia::render('exercises/IndexPage', $props);
    }

    public function create()
    {
        return Inertia::render('exercises/CreatePage');
    }

    public function store(ExerciseStoreData $data)
    {
        $exercise = $this->exerciseService->storeExercise($data, auth()->user());

        return redirect()
            ->back()
            ->with(
                'message',
                FlashMessageData::from([
                    'component' => FlashComponent::ExerciseCreated,
                    'props' => [
                        'exercise' => ExerciseData::from($exercise),
                    ],
                ])
            );
    }

    public function edit(Exercise $exercise)
    {
        $props = new ExerciseEditProps(
            exercise: ExerciseData::fromModel($exercise)
        );

        return Inertia::render('exercises/EditPage', $props);
    }

    public function update(ExerciseUpdateData $data, Exercise $exercise)
    {
        $this->exerciseService->updateExercise($exercise, $data);

        return redirect()
            ->back()
            ->with(
                'message',
                FlashMessageData::from([
                    'component' => FlashComponent::ExerciseUpdated,
                    'props' => [
                        'exercise' => ExerciseData::from($exercise),
                    ],
                ])
            );
    }

    public function destroy(Exercise $exercise)
    {
        $exercise->delete();

        return redirect()->route('exercises.index');
    }
}
