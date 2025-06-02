<?php

namespace App\Jobs;

use App\Enums\ScheduleStatus;
use App\Models\Schedule;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class ScheduleStatusJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->updateStatusToMissedAndSave();
        $this->updateStatusToWaitForActionAndSave();
    }

    protected function updateStatusToWaitForActionAndSave(): void
    {
        Schedule::where('scheduled_at', '<', now())
            ->where('status', '=', ScheduleStatus::Scheduled)
            ->update([
                'status' => ScheduleStatus::WaitForAction,
            ]);
    }

    protected function updateStatusToMissedAndSave(): void
    {
        Schedule::where('scheduled_at', '<', now()->subDay())
            ->whereIn('status', [ScheduleStatus::WaitForAction, ScheduleStatus::Scheduled])
            ->update([
                'status' => ScheduleStatus::Missed,
            ]);
    }
}
