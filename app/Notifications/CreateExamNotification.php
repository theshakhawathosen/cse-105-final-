<?php

namespace App\Notifications;

use App\FormatsNotification;
use App\Models\Exam;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CreateExamNotification extends Notification
{
    use Queueable, FormatsNotification;

    public $exam;

    /**
     * Create a new notification instance.
     */
    public function __construct(Exam $exam)
    {
        $this->exam = $exam;
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
            $this->exam->exam_name,
            "{$this->exam->exam_type} exam will be held on {$this->exam->date}.",
            route('student.results'),
            "fas fa-file-pen"
        );
    }
}
