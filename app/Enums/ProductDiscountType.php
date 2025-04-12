<?php

namespace App\Enums;

enum ProductDiscountType: int
{
    case NO_DISCOUNT = 0;
    case PERCENTAGE = 1;
    case FIXED = 2;
}
