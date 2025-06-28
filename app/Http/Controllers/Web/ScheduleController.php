<?php

namespace App\Http\Controllers\Web;

use App\Data\Shared\Schedules\ScheduleData;
use App\Data\Web\FlashMessageWebData;
use App\Data\Web\Schedules\Pages\ScheduleShowProps;
use App\Enums\ScheduleStatus;
use App\Http\Controllers\BaseController;
use App\Models\Schedule;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\LaravelData\PaginatedDataCollection;

class ScheduleController extends BaseController
{
    public function show(Schedule $schedule): Response
    {
        $props = new ScheduleShowProps(
            schedule: ScheduleData::fromModel($schedule),
        );

        return Inertia::render('schedules/ShowPage', props: $props);
    }

    public function index(): Response
    {
        $user = $this->getUserOrThrow();
        $schedules = $user->schedules()->with(['workout', 'recurrence'])
            ->orderBy('scheduled_at')
            ->paginate(10);

        $props = ScheduleData::collect($schedules, PaginatedDataCollection::class);

        return Inertia::render('schedules/IndexPage', $props);
    }

    public function destroy(Schedule $schedule): RedirectResponse
    {
        $schedule->delete();

        return redirect()->route('schedules.index');
    }

    public function markAsDone(Schedule $schedule): RedirectResponse
    {
        $schedule->status = ScheduleStatus::Done;

        $schedule->save();

        return redirect()->back()->with(
            'message',
            new FlashMessageWebData(
                title: __('messages.schedules.flash.done')
            )
        );
    }

    public function markAsMissed(Schedule $schedule): RedirectResponse
    {
        $schedule->status = ScheduleStatus::Missed;

        $schedule->save();

        return redirect()->back()->with(
            'message',
            new FlashMessageWebData(
                title: __('messages.schedules.flash.missed')
            )
        );
    }
}
