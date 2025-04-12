<?php

namespace App\Services\Dashboard\EndPoint\Coupon\Factory;

use App\Services\Dashboard\EndPoint\Coupon\Factory\CouponDiscountFactory;

class CouponPriceCalculator
{
    public function calculatePrice(int $price, string $discountType, int $discountValue): int
    {
        $discountStrategy = CouponDiscountFactory::create($discountType);
        return $discountStrategy->apply($price, $discountValue);
    }
}
