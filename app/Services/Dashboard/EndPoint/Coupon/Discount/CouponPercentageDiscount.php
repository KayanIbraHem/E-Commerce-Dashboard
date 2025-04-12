<?php

namespace App\Services\Dashboard\EndPoint\Coupon\Discount;

use App\Services\Dashboard\EndPoint\Coupon\Interface\CouponDiscount;



class CouponPercentageDiscount implements CouponDiscount
{
    public function apply(int $price, int $discountValue): int
    {
        return max($price * (1 - $discountValue / 100), 0);
    }
}
