<?php

namespace App\Http\Controllers\Web;

use App\Data\Web\DashboardPageWebData;
use App\Data\Web\Schedules\ScheduleWebData;
use App\Enums\ScheduleStatus;
use App\Http\Controllers\BaseController;
use Carbon\Carbon;
use Inertia\Inertia;
use Inertia\Response;
use Spatie\LaravelData\DataCollection;

class DashboardController extends BaseController
{
    public function show(): Response
    {
        $user = $this->getUserOrThrow();
        $schedules = $user->schedules()->with('workout')
            ->where('scheduled_at', '>=', Carbon::now())
            ->where('status', '=', ScheduleStatus::Scheduled)
            ->orderByDesc('scheduled_at')
            ->limit(5)
            ->get();

        $props = new DashboardPageWebData(
            schedules: ScheduleWebData::collect($schedules, DataCollection::class)
        );

        return Inertia::render('DashboardPage', $props);
    }
}
