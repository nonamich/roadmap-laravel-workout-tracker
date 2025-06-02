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
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $schedules = auth()->user()->schedules()->with('workout')
            ->orderByDesc('scheduled_at')
            ->paginate(5);

        $props = ScheduleData::collect($schedules, PaginatedDataCollection::class);

        return Inertia::render('schedules/IndexPage', $props);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExerciseStoreData $data)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Schedule $exercise)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(array $data, Schedule $exercise)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('schedules.index');
    }
}
