<?php

namespace App\Services\Dashboard\EndPoint\Coupon\Interface;

interface CouponDiscount
{
    public function apply(int $price, int $discountValue): int;
}
