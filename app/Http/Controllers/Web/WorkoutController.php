<?php

namespace App\Http\Controllers\Web;

use App\Data\Exercises\ExerciseData;
use App\Data\FlashMessageData;
use App\Data\Recurrences\RecurrenceData;
use App\Data\Workouts\Pages\Edit\WorkoutEditExercisesProps;
use App\Data\Workouts\Pages\Edit\WorkoutEditProps;
use App\Data\Workouts\Pages\WorkoutCreateProps;
use App\Data\Workouts\Store\WorkoutStoreData;
use App\Data\Workouts\WorkoutData;
use App\Enums\FlashComponent;
use App\Http\Controllers\BaseController;
use App\Models\Scopes\SortScope;
use App\Models\Workout;
use App\Services\WorkoutService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\PaginatedDataCollection;

class WorkoutController extends BaseController
{
    public function __construct(
        public readonly WorkoutService $workoutService
    ) {}

    public function index(): Response
    {
        $user = auth()->user();

        if (! $user) {
            abort(401);
        }

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
        $user = auth()->user();

        if (! $user) {
            abort(401);
        }

        $exercises = $user->exercises()->latest()->get();
        $props = new WorkoutCreateProps(
            exercises: ExerciseData::collect($exercises, DataCollection::class)
        );

        return Inertia::render('workouts/CreatePage', $props);
    }

    public function store(WorkoutStoreData $workoutStoreData): RedirectResponse
    {
        $user = auth()->user();

        if (! $user) {
            abort(401);
        }

        $workout = $this->workoutService->createOrUpdate($workoutStoreData, $user);

        return redirect()->route('workouts.edit', $workout->id);
    }

    public function edit(Workout $workout): Response
    {
        $user = auth()->user();

        if (! $user) {
            abort(401);
        }

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
            recurrences: RecurrenceData::collect(
                $recurrences,
                DataCollection::class
            ),
        );

        return Inertia::render('workouts/EditPage', $props);
    }

    public function update(Workout $workout, WorkoutStoreData $workoutStoreData): RedirectResponse
    {
        if (! $workoutStoreData->id || $workout->id !== $workoutStoreData->id) {
            abort(400);
        }

        $user = auth()->user();

        if (! $user) {
            abort(401);
        }

        $workout = $this->workoutService->createOrUpdate($workoutStoreData, $user);

        return redirect()->back()
            ->with(
                'message',
                FlashMessageData::from([
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
