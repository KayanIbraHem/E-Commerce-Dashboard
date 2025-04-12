<?php
namespace App\Services\Dashboard\EndPoint\Coupon\Discount;


use App\Services\Dashboard\EndPoint\Coupon\Interface\CouponDiscount;

class CouponNoDiscount implements CouponDiscount
{
    public function apply(int $price, int $discountValue): int
    {
        return $price;
    }
}
