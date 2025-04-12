<?php

namespace App\Enums;

enum CouponDiscountType: int
{
    case FIXED = 1;
    case PERCENTAGE = 2;
}
