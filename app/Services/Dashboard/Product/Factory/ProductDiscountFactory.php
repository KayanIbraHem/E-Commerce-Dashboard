<?php
namespace App\Services\Dashboard\Product\Factory;


use App\Enums\ProductDiscountType;
use App\Services\Dashboard\Product\Discount\NoDiscount;
use App\Services\Dashboard\Product\Discount\FixedDiscount;
use App\Services\Dashboard\Product\Interface\ProductDiscount;
use App\Services\Dashboard\Product\Discount\PercentageDiscount;

class ProductDiscountFactory
{
    public static function create(string $discountType): ProductDiscount
    {
        return  match ($discountType) {
            "" . ProductDiscountType::FIXED->value . "" => new FixedDiscount(),
            "" . ProductDiscountType::PERCENTAGE->value . "" => new PercentageDiscount(),
            "" . ProductDiscountType::NO_DISCOUNT->value . "" => new NoDiscount(),
            default => throw new \InvalidArgumentException("Invalid guard: $discountType"),
        };
    }
}
