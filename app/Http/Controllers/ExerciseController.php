<?php

namespace App\Http\Controllers;

use App\Data\Exercises\ExerciseData;
use App\Data\Exercises\ExerciseStoreData;
use App\Data\Exercises\ExerciseUpdateData;
use App\Data\FlashMessageData;
use App\Enums\FlashComponent;
use App\Models\Exercise;
use App\Models\Scopes\SortScope;
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
            ->withGlobalScope(
                'sort',
                new SortScope(allowedBy: ['created_at', 'name'])
            )
            ->paginate(5)
            ->withQueryString();
        $props = ExerciseData::collect($exercises, PaginatedDataCollection::class);

        return Inertia::render('exercises/IndexPage', $props);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('exercises/CreatePage');
    }

    /**
     * Store a newly created resource in storage.
     */
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
        return Inertia::render('exercises/EditPage', [
            'exercise' => $exercise,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
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
