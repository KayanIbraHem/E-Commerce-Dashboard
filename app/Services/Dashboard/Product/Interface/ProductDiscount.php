<?php
namespace App\Services\Dashboard\Product\Interface;


interface ProductDiscount
{
    public function apply(int $price, int $discountValue): int;
}
