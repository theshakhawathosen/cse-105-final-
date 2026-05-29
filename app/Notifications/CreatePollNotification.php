<?php

namespace App\Notifications;

use App\FormatsNotification;
use App\Models\Poll;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CreatePollNotification extends Notification
{
    use Queueable, FormatsNotification;

    public $poll;

    /**
     * Create a new notification instance.
     */
    public function __construct(Poll $poll)
    {
        $this->poll = $poll;
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
            "New Poll Published",
            $this->poll->question,
            route('student.polls'),
            "fas fa-square-poll-vertical"
        );
    }
}
