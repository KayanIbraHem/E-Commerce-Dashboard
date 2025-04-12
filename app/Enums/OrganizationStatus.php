<?php

namespace App\Enums;

enum OrganizationStatus: int
{
    case PENDING = 0;
    case ACTIVE = 1;
    case INACTIVE = 2;
}
