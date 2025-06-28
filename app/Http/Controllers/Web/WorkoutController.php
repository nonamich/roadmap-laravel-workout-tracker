<?php

namespace App\Http\Controllers\Web;

use App\Data\Shared\Exercises\ExerciseData;
use App\Data\Shared\Workouts\WorkoutData;
use App\Data\Web\FlashMessageWebData;
use App\Data\Web\Recurrences\RecurrenceWebData;
use App\Data\Web\Workouts\Pages\WorkoutCreateProps;
use App\Data\Web\Workouts\Pages\WorkoutEditExercisesProps;
use App\Data\Web\Workouts\Pages\WorkoutEditProps;
use App\Data\Web\Workouts\Requests\WorkoutStoreWebData;
use App\Enums\FlashComponent;
use App\Http\Controllers\BaseController;
use App\Models\Scopes\SortScope;
use App\Models\Workout;
use App\Services\WorkoutWebService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\PaginatedDataCollection;

class WorkoutController extends BaseController
{
    public function __construct(
        public readonly WorkoutWebService $workoutService
    ) {}

    public function index(): Response
    {
        $user = $this->getUserOrThrow();
        $workouts = $user
            ->workouts()
            ->withGlobalScope(
                'sort',
                new SortScope(allowedBy: ['created_at', 'title'])
            )
            ->paginate(5)
            ->withQueryString();
        $props = WorkoutData::collect($workouts, PaginatedDataCollection::class);

        return Inertia::render('workouts/IndexPage', $props);

    }

    public function create(): Response
    {
        $user = $this->getUserOrThrow();
        $exercises = $user->exercises()->latest()->get();
        $props = new WorkoutCreateProps(
            exercises: ExerciseData::collect($exercises, DataCollection::class)
        );

        return Inertia::render('workouts/CreatePage', $props);
    }

    public function store(WorkoutStoreWebData $workoutStoreData): RedirectResponse
    {
        $user = $this->getUserOrThrow();
        $workout = $this->workoutService->createOrUpdate($workoutStoreData, $user);

        return redirect()->route('workouts.edit', $workout->id);
    }

    public function edit(Workout $workout): Response
    {
        $user = $this->getUserOrThrow();
        $exercises = $user->exercises()->get();
        $workoutExercises = $workout->exercises()->get();
        $recurrences = $workout->recurrences()->get();
        $props = new WorkoutEditProps(
            workout: WorkoutData::fromModel($workout),
            exercises: ExerciseData::collect($exercises, DataCollection::class),
            workoutExercises: WorkoutEditExercisesProps::collect(
                $workoutExercises,
                DataCollection::class
            ),
            recurrences: RecurrenceWebData::collect(
                $recurrences,
                DataCollection::class
            ),
        );

        return Inertia::render('workouts/EditPage', $props);
    }

    public function update(Workout $workout, WorkoutStoreWebData $workoutStoreData): RedirectResponse
    {
        if (! $workoutStoreData->id || $workout->id !== $workoutStoreData->id) {
            abort(400);
        }

        $user = $this->getUserOrThrow();
        $workout = $this->workoutService->createOrUpdate($workoutStoreData, $user);

        return redirect()->back()
            ->with(
                'message',
                FlashMessageWebData::from([
                    'component' => FlashComponent::WorkoutUpdated,
                    'props' => [
                        'workout' => WorkoutData::fromModel($workout),
                    ],
                ])
            );

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workout $workout): RedirectResponse
    {
        $workout->delete();

        return redirect()->route('workouts.index');
    }
}
