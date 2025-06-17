<?php

namespace App\Http\Controllers\Web;

use App\Data\Shared\Exercises\ExerciseData;
use App\Data\Shared\Exercises\ExerciseStoreData;
use App\Data\Shared\Exercises\ExerciseUpdateData;
use App\Data\Web\Exercises\Pages\Edit\ExerciseEditProps;
use App\Data\Web\FlashMessageData;
use App\Enums\FlashComponent;
use App\Http\Controllers\BaseController;
use App\Models\Exercise;
use App\Models\Scopes\SortScope;
use App\Services\ExerciseService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\LaravelData\PaginatedDataCollection;

class ExerciseController extends BaseController
{
    public function __construct(private ExerciseService $exerciseService) {}

    public function index(): Response
    {
        $user = auth()->user();

        if (! $user) {
            abort(401);
        }

        $exercises = $user
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

    public function create(): Response
    {
        return Inertia::render('exercises/CreatePage');
    }

    public function store(ExerciseStoreData $data): RedirectResponse
    {
        $user = auth()->user();

        if (! $user) {
            abort(401);
        }

        $exercise = $this->exerciseService->storeExercise($data, $user);

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

    public function edit(Exercise $exercise): Response
    {
        $props = new ExerciseEditProps(
            exercise: ExerciseData::fromModel($exercise)
        );

        return Inertia::render('exercises/EditPage', $props);
    }

    public function update(ExerciseUpdateData $data, Exercise $exercise): RedirectResponse
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

    public function destroy(Exercise $exercise): RedirectResponse
    {
        $exercise->delete();

        return redirect()->route('exercises.index');
    }
}
