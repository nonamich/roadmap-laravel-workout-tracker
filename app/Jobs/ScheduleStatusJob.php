<?php

namespace App\Jobs;

use App\Services\ScheduleService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ScheduleStatusJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct() {}

    /**
     * Execute the job.
     */
    public function handle(ScheduleService $scheduleService): void
    {
        $scheduleService->updateStatusToWaitForActionAndSave();
        $scheduleService->updateStatusToMissedAndSave();
    }
}
