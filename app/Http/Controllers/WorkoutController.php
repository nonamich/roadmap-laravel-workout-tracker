<?php

namespace App\Http\Controllers;

use App\Data\Exercises\ExerciseData;
use App\Data\Props\WorkoutCreateData;
use App\Data\Props\WorkoutCreateExercisesData;
use App\Data\Recurrences\RecurrenceData;
use App\Data\Workouts\WorkoutData;
use App\Data\Workouts\WorkoutStoreData;
use App\Models\Scopes\SortScope;
use App\Models\Workout;
use App\Services\WorkoutService;
use Illuminate\Http\Request;
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

        return Inertia::render('workouts/CreatePage', [
            'exercises' => ExerciseData::collect($exercises),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(WorkoutStoreData $workoutStoreData)
    {
        $this->workoutService->createWorkout($workoutStoreData, auth()->user());
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
        $exercises = auth()->user()->exercises()->latest()->get();
        $exercises = $workout->exercises()->get();
        $recurrences = $workout->recurrences()->get();

        $props = new WorkoutCreateData(
            workout: WorkoutData::fromModel($workout),
            exercises: WorkoutCreateExercisesData::collect($exercises, DataCollection::class),
            recurrences: RecurrenceData::collect($recurrences, DataCollection::class)
        );

        return Inertia::render('workouts/EditPage', $props);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Workout $workout)
    {
        //
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
