<?php

namespace App\Http\Controllers;

use App\Data\DashboardPageData;
use App\Data\Exercises\ExerciseData;
use App\Data\Exercises\ExerciseStoreData;
use App\Data\Exercises\ExerciseUpdateData;
use App\Data\FlashMessageData;
use App\Data\Schedules\ScheduleData;
use App\Data\Schedules\ScheduleIndexData;
use App\Enums\FlashComponent;
use App\Models\Exercise;
use App\Models\Schedule;
use App\Models\Scopes\SortScope;
use App\Services\ExerciseService;
use Carbon\Carbon;
use Inertia\Inertia;
use Spatie\LaravelData\PaginatedDataCollection;

class ScheduleController
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = auth()->user()->schedules()->with(['workout', 'recurrence'])
            ->orderBy('scheduled_at')
            ->paginate(10);

        $props = ScheduleData::collect($schedules, PaginatedDataCollection::class);

        return Inertia::render('schedules/IndexPage', $props);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('schedules.index');
    }

    public function markAsDone(Schedule $schedule)
    {
        $schedule->markAsDone();
    }

    public function markAsMissed(Schedule $schedule)
    {
        $schedule->markAsMissed();
    }
}
