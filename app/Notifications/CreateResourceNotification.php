<?php

namespace App\Notifications;

use App\FormatsNotification;
use App\Models\Resource;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CreateResourceNotification extends Notification
{
    use Queueable, FormatsNotification;

    public $resource;

    /**
     * Create a new notification instance.
     */
    public function __construct(Resource $resource)
    {
        $this->resource = $resource;
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
        $categoryText = match ($this->resource->category) {
            'notes' => 'Notes',
            'slides' => 'Slides',
            'book' => 'Book',
            'lab_manual' => 'Lab Manual',
            'assignment_solution' => 'Assignment Solution',
            'question_bank' => 'Question Bank',
            'tutorial' => 'Tutorial',
            default => 'Resource',
        };

        return $this->formatNotification(
            $this->resource->title,
            "{$categoryText} has been added for {$this->resource->subject->name}.",
            route('student.resources'),
            "fas fa-book-open"
        );
    }
}
