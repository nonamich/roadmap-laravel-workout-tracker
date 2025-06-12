<?php

namespace App\Http\Controllers\Web;

use App\Data\FlashMessageData;
use App\Data\Schedules\Pages\ScheduleShowProps;
use App\Data\Schedules\ScheduleData;
use App\Http\Controllers\BaseController;
use App\Models\Schedule;
use Inertia\Inertia;
use Spatie\LaravelData\PaginatedDataCollection;

class ScheduleController extends BaseController
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
                title: __('messages.schedules.flash.done')
            )
        );
    }

    public function markAsMissed(Schedule $schedule)
    {
        $schedule->markAsMissed();

        return redirect()->back()->with(
            'message',
            new FlashMessageData(
                title: __('messages.schedules.flash.missed')
            )
        );
    }
}
