<?php

namespace App\Enums;

enum Priority: string
{
    case Low = 'low';
    case Medium = 'medium';
    case High = 'high';

    public static function values(): array
    {
        return [
            self::Low->value,
            self::Medium->value,
            self::High->value,
        ];
    }
}
