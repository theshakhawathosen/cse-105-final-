<?php

namespace App\Notifications;

use App\FormatsNotification;
use App\Models\LabReport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreateLabReportNotification extends Notification
{
    use Queueable,FormatsNotification;

    /**
     * Create a new notification instance.
     */
    public $labreport;
    public function __construct(LabReport $labreport)
    {
        $this->labreport = $labreport;
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
        return $this->formatNotification($this->labreport->title,$this->labreport->description,route('student.lab-report.show',$this->labreport->id),"fas fa-flask");
    }
}
