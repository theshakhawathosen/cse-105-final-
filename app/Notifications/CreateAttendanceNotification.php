<?php

namespace App\Notifications;

use App\FormatsNotification;
use App\Models\Attendance;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CreateAttendanceNotification extends Notification
{
    use Queueable, FormatsNotification;

    public $attendance;

    /**
     * Create a new notification instance.
     */
    public function __construct(Attendance $attendance)
    {
        $this->attendance = $attendance;
    }

    /**
     * Get notification channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Notification data.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return $this->formatNotification(
            $this->attendance->subject->name . " Attendance",
            "Attendance has been taken for " . $this->attendance->date,
            route('student.attendances'),
            "fas fa-user-check"
        );
    }
}
