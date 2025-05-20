<?php

namespace App\Http\Controllers;

use App\Data\StoreExerciseData;
use App\Data\UpdateExerciseData;
use App\Http\Requests\Exercise\StoreExerciseRequest;
use App\Http\Requests\Exercise\UpdateExerciseRequest;
use App\Models\Exercise;
use App\Services\ExerciseService;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ExerciseController
{
    public function __construct(private ExerciseService $exerciseService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $props = Auth::user()->exercises()->paginate(5)->withQueryString();

        $a = Exercise::sort();

        return Inertia::render('Exercise/IndexPage', $props);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Exercise/CreatePage');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExerciseRequest $request)
    {
        $data = new StoreExerciseData(
            name: $request->input('name'),
            category: $request->input('category'),
            description: $request->input('description'),
            userId: $request->user()->id,
        );
        $exercise = $this->exerciseService->storeExercise($data);

        return redirect()->route('exercises.edit', [
            'exercise' => $exercise,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exercise $exercise)
    {
        return Inertia::render('Exercise/EditPage', [
            'exercise' => $exercise,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExerciseRequest $request, Exercise $exercise)
    {
        $data = new UpdateExerciseData(
            name: $request->input('name'),
            category: $request->input('category'),
            description: $request->input('description'),
        );
        $this->exerciseService->updateExercise($exercise, $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exercise $exercise)
    {
        $exercise->delete();

        return redirect()->route('exercises.index');
    }
}
