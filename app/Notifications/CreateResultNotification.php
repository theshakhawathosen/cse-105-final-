<?php

namespace App\Notifications;

use App\FormatsNotification;
use App\Models\Result;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CreateResultNotification extends Notification
{
    use Queueable, FormatsNotification;

    public $result;

    /**
     * Create a new notification instance.
     */
    public function __construct(Result $result)
    {
        $this->result = $result;
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
            $this->result->exam->title . " Result Published",
            $this->result->subject->name . " result has been published.",
            route('student.results'),
            "fas fa-square-poll-vertical"
        );
    }
}
