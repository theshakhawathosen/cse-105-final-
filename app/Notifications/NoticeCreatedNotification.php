<?php

namespace App\Notifications;

use App\FormatsNotification;
use App\Models\Notice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NoticeCreatedNotification extends Notification
{
    use Queueable,FormatsNotification;

    /**
     * Create a new notification instance.
     */

    public $notice;

    public function __construct(Notice $notice)
    {
        $this->notice = $notice;
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
     * Get the mail representation of the notification.
     */

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {

        return $this->formatNotification($this->notice->title,$this->notice->content,route('student.notice.show',$this->notice->id),"fa-solid fa-bullhorn");
    }
}
