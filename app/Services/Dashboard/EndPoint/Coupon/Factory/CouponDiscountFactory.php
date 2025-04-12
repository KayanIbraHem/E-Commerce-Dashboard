<?php

namespace App\Services\Dashboard\EndPoint\Coupon\Factory;


use App\Enums\CouponDiscountType;
use App\Services\Dashboard\EndPoint\Coupon\Interface\CouponDiscount;
use App\Services\Dashboard\EndPoint\Coupon\Discount\CouponFixedDiscount;
use App\Services\Dashboard\EndPoint\Coupon\Discount\CouponPercentageDiscount;

class CouponDiscountFactory
{
    public static function create(string $discountType): CouponDiscount
    {
        return  match ($discountType) {
            "" . CouponDiscountType::FIXED->value . "" => new CouponFixedDiscount(),
            "" . CouponDiscountType::PERCENTAGE->value . "" => new CouponPercentageDiscount(),
            default => throw new \InvalidArgumentException("Invalid guard: $discountType"),
        };
    }
}
