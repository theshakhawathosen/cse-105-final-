<?php

namespace App\Notifications;

use App\FormatsNotification;
use App\Models\Link;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CreateLinkNotification extends Notification
{
    use Queueable, FormatsNotification;

    public $link;

    /**
     * Create a new notification instance.
     */
    public function __construct(Link $link)
    {
        $this->link = $link;
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
        $typeText = match ($this->link->type) {
            'google classroom' => 'Google Classroom Link',
            'group' => 'Group Link',
            default => 'Link',
        };

        return $this->formatNotification(
            $this->link->title,
            "{$typeText} has been added.",
            route('student.links'),
            "fas fa-link"
        );
    }
}
