<?php

namespace App\Services;

use App\Data\Api\Reports\ReportData;
use App\Data\Api\Reports\ReportRequestData;
use App\Data\Api\Reports\ReportsData;
use App\Enums\ScheduleStatus;
use App\Models\User;

class ReportService
{
    public function generate(User $user, ReportRequestData $data): ReportsData
    {
        $schedules = $user->schedules()
            ->with(['workout', 'workout.exercises', 'workout.exercises.workouts'])
            ->where('status', '=', ScheduleStatus::Done)
            ->whereBetween('scheduled_at', [$data->startTime, $data->endTime])
            ->orderBy('scheduled_at')
            ->get();

        return new ReportsData(
            data: ReportData::collect($schedules),
            startTime: $data->startTime,
            endTime: $data->endTime,
        );
    }
}
