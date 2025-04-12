<?php
namespace App\Services\Dashboard\Product\Discount;

use App\Services\Dashboard\Product\Interface\ProductDiscount;



class FixedDiscount implements ProductDiscount
{
    public function apply(int $price, int $discountValue): int
    {
        return max($price - $discountValue, 0);
    }
}
