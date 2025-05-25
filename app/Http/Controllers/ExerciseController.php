<?php

namespace App\Http\Controllers;

use App\Data\ExerciseData;
use App\Data\FlashMessageData;
use App\Data\StoreExerciseData;
use App\Data\UpdateExerciseData;
use App\Enums\FlashComponent;
use App\Http\Requests\Exercise\StoreExerciseRequest;
use App\Http\Requests\Exercise\UpdateExerciseRequest;
use App\Models\Exercise;
use App\Services\ExerciseService;
use Inertia\Inertia;
use Spatie\LaravelData\PaginatedDataCollection;

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
        $exercises = auth()->user()
            ->exercises()
            ->sorted(
                request()->get('sort_by'),
                request()->get('sort_dir')
            )
            ->paginate(5)
            ->withQueryString();
        $props = ExerciseData::collect($exercises, PaginatedDataCollection::class);

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

        return redirect()
            ->back()
            ->with(
                'message',
                FlashMessageData::from([
                    'component' => FlashComponent::ExerciseCreated,
                    'props' => [
                        'exercise' => ExerciseData::from($exercise)
                    ],
                ])
            );
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

        return redirect()
            ->back()
            ->with(
                'message',
                FlashMessageData::from([
                    'component' => FlashComponent::ExerciseUpdated,
                    'props' => [
                        'exercise' => ExerciseData::from($exercise)
                    ],
                ])
            );
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
