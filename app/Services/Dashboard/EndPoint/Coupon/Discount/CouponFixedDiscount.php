<?php

namespace App\Services\Dashboard\EndPoint\Coupon\Discount;

use App\Services\Dashboard\EndPoint\Coupon\Interface\CouponDiscount;

class CouponFixedDiscount implements CouponDiscount
{
    public function apply(int $price, int $discountValue): int
    {
        return max($price - $discountValue, 0);
    }
}
