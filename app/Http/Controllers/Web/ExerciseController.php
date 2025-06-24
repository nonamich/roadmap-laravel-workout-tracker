<?php

namespace App\Http\Controllers\Web;

use App\Data\Shared\Exercises\ExerciseStoreData;
use App\Data\Shared\Exercises\ExerciseUpdateData;
use App\Data\Web\Exercises\ExerciseWebData;
use App\Data\Web\Exercises\Pages\ExerciseEditProps;
use App\Data\Web\FlashMessageWebData;
use App\Enums\FlashComponent;
use App\Http\Controllers\BaseController;
use App\Models\Exercise;
use App\Models\Scopes\SortScope;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\LaravelData\PaginatedDataCollection;

class ExerciseController extends BaseController
{
    public function index(): Response
    {
        $user = $this->getUserOrThrow();
        $exercises = $user
            ->exercises()
            ->withGlobalScope(
                'sort',
                new SortScope(allowedBy: ['created_at', 'name'])
            )
            ->paginate(5)
            ->withQueryString();
        $props = ExerciseWebData::collect($exercises, PaginatedDataCollection::class);

        return Inertia::render('exercises/IndexPage', $props);
    }

    public function create(): Response
    {
        return Inertia::render('exercises/CreatePage');
    }

    public function store(ExerciseStoreData $data): RedirectResponse
    {
        $user = $this->getUserOrThrow();
        $exercise = Exercise::create([
            ...$data->toArray(),
            'user_id' => $user->id,
        ]);

        return redirect()
            ->back()
            ->with(
                'message',
                FlashMessageWebData::from([
                    'component' => FlashComponent::ExerciseCreated,
                    'props' => [
                        'exercise' => ExerciseWebData::from($exercise),
                    ],
                ])
            );
    }

    public function edit(Exercise $exercise): Response
    {
        $props = new ExerciseEditProps(
            exercise: ExerciseWebData::fromModel($exercise)
        );

        return Inertia::render('exercises/EditPage', $props);
    }

    public function update(ExerciseUpdateData $data, Exercise $exercise): RedirectResponse
    {
        $exercise->update($data->toArray());

        return redirect()
            ->back()
            ->with(
                'message',
                FlashMessageWebData::from([
                    'component' => FlashComponent::ExerciseUpdated,
                    'props' => [
                        'exercise' => ExerciseWebData::from($exercise),
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
