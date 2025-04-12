<?php

namespace App\Services\Dashboard\EndPoint\Coupon\Product;

use App\Models\Product\Product\Product;

class ProductStockQuantity
{
    public function updateStock($id, $quantity)
    {
        $product = $this->getProduct($id);
        $this->decrementQuantity($product, $quantity);
        $this->incrementQuantityPurchase($product, $quantity);
    }
    public function decrementQuantity($product, $quantity)
    {
        $product->decrement('quantity', $quantity);
    }
    public function incrementQuantityPurchase($product, $quantity)
    {
        $product->increment('quantity_purchase', $quantity);
    }
    public function getProduct($id)
    {
        return Product::whereId($id)->first();
    }
}
