<?php

namespace App\Notifications;

use App\Models\Schedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyWaitForAction extends Notification implements ShouldQueue
{
    use Queueable;

    private Schedule $schedule;

    /**
     * Create a new notification instance.
     */
    public function __construct(private int $scheduleId)
    {
        $this->schedule = Schedule::findOrFail($scheduleId)->first();
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->to($this->getMessage())
            ->action('See', route('schedules.index'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'scheduleId' => $this->schedule->id,
        ];
    }
}
