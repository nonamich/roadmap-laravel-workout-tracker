<?php

namespace App\Http\Controllers;

use App\Data\DashboardPageData;
use App\Data\Exercises\ExerciseData;
use App\Data\Exercises\ExerciseStoreData;
use App\Data\Exercises\ExerciseUpdateData;
use App\Data\FlashMessageData;
use App\Data\Schedules\Pages\ScheduleShowProps;
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

    public function show(Schedule $schedule)
    {
        $props = new ScheduleShowProps(
            schedule: ScheduleData::fromModel($schedule),
        );

        return Inertia::render('schedules/ShowPage', props: $props);
    }

    public function index()
    {
        $schedules = auth()->user()->schedules()->with(['workout', 'recurrence'])
            ->orderBy('scheduled_at')
            ->paginate(10);

        $props = ScheduleData::collect($schedules, PaginatedDataCollection::class);

        return Inertia::render('schedules/IndexPage', $props);
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('schedules.index');
    }

    public function markAsDone(Schedule $schedule)
    {
        $schedule->markAsDone();

        return redirect()->back()->with(
            'message',
            new FlashMessageData(
                title: 'Schedule was marked as done'
            )
        );
    }

    public function markAsMissed(Schedule $schedule)
    {
        $schedule->markAsMissed();

        return redirect()->back()->with(
            'message',
            new FlashMessageData(
                title: 'Schedule was marked as done'
            )
        );
    }
}
