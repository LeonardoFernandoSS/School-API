<?php

namespace App\Enums;

enum StatusEnum: string
{
    case ACTIVE = 'active';
    case BLOCK = 'block';
    case DELETE = 'delete';

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
