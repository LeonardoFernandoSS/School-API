<?php

namespace App\Enums;

enum StatusEnum: string
{
    case ACTIVE = 'active';
    case BLOCK = 'block';
    case DELETE = 'delete';
}
