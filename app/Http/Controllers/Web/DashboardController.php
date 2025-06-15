<?php

namespace App\Http\Controllers\Web;

use App\Data\DashboardPageData;
use App\Data\Schedules\ScheduleData;
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
        $user = auth()->user();

        if (! $user) {
            abort(401);
        }

        $schedules = $user->schedules()->with('workout')
            ->where('scheduled_at', '>=', Carbon::now())
            ->where('status', '=', ScheduleStatus::Scheduled)
            ->orderByDesc('scheduled_at')
            ->limit(5)
            ->get();

        $props = new DashboardPageData(
            schedules: ScheduleData::collect($schedules, DataCollection::class)
        );

        return Inertia::render('DashboardPage', $props);
    }
}
