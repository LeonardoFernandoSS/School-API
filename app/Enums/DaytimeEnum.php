<?php

namespace App\Enums;

enum DaytimeEnum: string
{
    case MORNING = 'morning';
    case AFTERNOON = 'afternoon';
    case EVENING = 'evening';

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
