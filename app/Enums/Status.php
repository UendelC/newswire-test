<?php

namespace App\Enums;

enum Status: string
{
    case Pending = 'pending';
    case InProgress = 'in-progress';
    case Completed = 'completed';

    public static function values(): array
    {
        return [
            self::Pending->value,
            self::InProgress->value,
            self::Completed->value,
        ];
    }
}
