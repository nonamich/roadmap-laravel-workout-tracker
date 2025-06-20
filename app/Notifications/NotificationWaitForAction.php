<?php

namespace App\Notifications;

use App\Models\Schedule;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotificationWaitForAction extends Notification implements ShouldQueue
{
    use Queueable;

    private Schedule $schedule;

    /**
     * Create a new notification instance.
     */
    public function __construct(int $scheduleId)
    {
        $this->schedule = Schedule::findOrFail($scheduleId);
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
        return (new MailMessage)->markdown('mail.wait-for-action', [
            'schedule' => $this->schedule,
        ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $scheduleLink = route('schedules.show', $this->schedule->id);

        return [
            'message' => __('messages.schedules.events.wait-for-action'),
            'link' => $scheduleLink,
        ];
    }
}
