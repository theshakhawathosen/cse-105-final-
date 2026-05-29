<?php

namespace App\Notifications;

use App\FormatsNotification;
use App\Models\Feedback;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StudentCreateFeedback extends Notification
{
    use Queueable,FormatsNotification;

    /**
     * Create a new notification instance.
     */
    public $feedback;
    public $user;
    public function __construct(Feedback $feedback,$user)
    {
        $this->feedback = $feedback;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        $title = $this->user->name. " send a feedback!";
        return $this->formatNotification($title, $this->feedback->description, route('feedbacks.index'),'fa-regular fa-comment');
    }
}
