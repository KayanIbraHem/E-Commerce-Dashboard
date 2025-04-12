<?php
namespace App\Services\Dashboard\Product\Discount;

use App\Services\Dashboard\Product\Interface\ProductDiscount;



class NoDiscount implements ProductDiscount
{
    public function apply(int $price, int $discountValue): int
    {
        return $price;
    }
}
