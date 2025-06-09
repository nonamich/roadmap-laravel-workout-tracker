<?php

namespace App\Http\Controllers;

use App\Data\Exercises\ExerciseData;
use App\Data\FlashMessageData;
use App\Data\Workouts\Pages\Create\WorkoutCreateProps;
use App\Data\Workouts\Pages\Edit\WorkoutEditProps;
use App\Data\Workouts\Pages\Edit\WorkoutEditExercisesProps;
use App\Data\Recurrences\RecurrenceData;
use App\Data\Workouts\WorkoutData;
use App\Data\Workouts\Store\WorkoutStoreData;
use App\Enums\FlashComponent;
use App\Models\Scopes\SortScope;
use App\Models\Workout;
use App\Services\WorkoutService;
use Inertia\Inertia;
use Spatie\LaravelData\DataCollection;
use Spatie\LaravelData\PaginatedDataCollection;

class WorkoutController
{
    public function __construct(
        public readonly WorkoutService $workoutService
    ) {

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $workouts = auth()->user()
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

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $exercises = auth()->user()->exercises()->latest()->get();
        $props = new WorkoutCreateProps(
            exercises: ExerciseData::collect($exercises, DataCollection::class)
        );

        return Inertia::render('workouts/CreatePage', $props);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WorkoutStoreData $workoutStoreData)
    {
        $workout = $this->workoutService->createOrUpdate($workoutStoreData, auth()->user());

        return redirect()->route('workouts.show', $workout->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Workout $workout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workout $workout)
    {
        $exercises = auth()->user()->exercises()->get();
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Workout $workout, WorkoutStoreData $workoutStoreData)
    {
        if (!$workoutStoreData->id || $workout->id !== $workoutStoreData->id) {
            abort(400);
        }

        $workout = $this->workoutService->createOrUpdate($workoutStoreData, auth()->user());

        return redirect()->back()
            ->with(
                'message',
                FlashMessageData::from([
                    'component' => FlashComponent::WorkoutUpdated,
                    'props' => [
                        'workout' => WorkoutData::fromModel($workout)
                    ],
                ])
            );
        ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workout $workout)
    {
        $workout->delete();

        return redirect()->route('workouts.index');
    }
}
