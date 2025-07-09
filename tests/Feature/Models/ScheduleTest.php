<?php

use App\Enums\ScheduleStatus;
use App\Jobs\ScheduleStatusJob;
use App\Models\Schedule;
use App\Models\User;
use App\Notifications\NotificationWaitForAction;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Notification;

use function Pest\Laravel\travel;

it('should change status wait-for-action', function () {
    Notification::fake();

    $user = User::factory()->createOne();
    $schedule = Schedule::factory()->for($user)->createOne();

    travel(1)->hour();

    dispatch(new ScheduleStatusJob);

    $schedule->refresh();

    expect($schedule->status)->toBe(ScheduleStatus::WaitForAction);

    Notification::assertSentTo($user, NotificationWaitForAction::class);
});

it('should throw exception with recurrence_id', function () {
    $schedule = Schedule::factory()->withRecurrence()->createOne();

    expect(fn () => $schedule->delete())->toThrow(AuthorizationException::class);
});
