<?php

namespace App\Notifications;

use App\FormatsNotification;
use App\Models\Routine;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CreateRoutineNotification extends Notification
{
    use Queueable, FormatsNotification;

    public $routine;

    /**
     * Create a new notification instance.
     */
    public function __construct(Routine $routine)
    {
        $this->routine = $routine;
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
        $typeText = match ($this->routine->type) {
            'class_routine' => 'Class Routine',
            'mid_exam_routine' => 'Mid Exam Routine',
            'final_exam_routine' => 'Final Exam Routine',
            default => 'Routine',
        };

        return $this->formatNotification(
            $this->routine->title,
            "{$typeText} has been published.",
            route('student.routine'),
            "fas fa-calendar-alt"
        );
    }
}
