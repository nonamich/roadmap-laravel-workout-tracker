<?php

namespace App\Http\Controllers;

use App\Data\DashboardPageData;
use App\Data\Schedules\ScheduleData;
use App\Enums\ScheduleStatus;
use Carbon\Carbon;
use Inertia\Inertia;
use Spatie\LaravelData\DataCollection;

class DashboardController
{
    public function show()
    {
        $schedules = auth()->user()->schedules()->with('workout')
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
