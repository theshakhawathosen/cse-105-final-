<?php

namespace App\Notifications;

use App\FormatsNotification;
use App\Models\Assignment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreateAssignmentNotification extends Notification
{
    use Queueable,FormatsNotification;

    /**
     * Create a new notification instance.
     */
    public $assignment;
    public function __construct(Assignment $assignment)
    {
        $this->assignment = $assignment;
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
        return $this->formatNotification($this->assignment->title,$this->assignment->description,route('student.assignment.show',$this->assignment->id),'fa-solid fa-tasks');
    }
}
