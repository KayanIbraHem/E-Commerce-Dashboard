<?php

namespace App\Services\Dashboard\Product\Factory;

use App\Services\Dashboard\Product\Factory\ProductDiscountFactory;

class PriceCalculator
{
    public function calculatePrice(int $price, string $discountType, int $discountValue): int
    {
        $discountStrategy = ProductDiscountFactory::create($discountType);
        return $discountStrategy->apply($price, $discountValue);
    }
}
