<?php

namespace App\Enums;

enum PeriodsEnum: string
{
    case MONTHLY = 'monthly';
    case BIMONTHLY = 'bimonthly';
    case QUARTERLY = 'quarterly';
    case BIANNUAL = 'biannual';
    case ANNUAL = 'annual';

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
