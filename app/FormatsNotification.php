<?php

namespace App;

trait FormatsNotification
{
    public function formatNotification(
        string $title,
        string $message,
        string $route,
        string $icon
    ): array {
        return [
            'title' => $title,
            'message' => $message,
            'route' => $route,
            'icon' => $icon,
        ];
    }
}
