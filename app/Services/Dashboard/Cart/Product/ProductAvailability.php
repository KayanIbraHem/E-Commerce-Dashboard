<?php

namespace App\Services\Dashboard\Cart\Product;

use App\Enums\ProductStatus;
use App\Models\Product\Product\Product;
use Illuminate\Validation\ValidationException;

class ProductAvailability
{
    public function checkProductAvailability($productId, $quantity, $organizationId)
    {
        $product = Product::whereOrganizationId($organizationId)->whereId($productId)->first();
        $availableQuantity = $product->quantity - $product->quantity_purchase;
        if (!$product) {
            throw ValidationException::withMessages([
                'product_id' => __('message.product_not_found'),
            ]);
        }

        if ($product->status != ProductStatus::ACTIVE->value) {
            throw ValidationException::withMessages([
                'product_id' => __('message.product_not_available'),
            ]);
        }

        if ($product->quantity == $product->quantity_purchase) {
            throw ValidationException::withMessages([
                'quantity' => __('message.insufficient_stock'),
            ]);
        }
        if ($quantity > $availableQuantity) {
            throw new \Exception(__('message.available_quantity', ['quantity' => $availableQuantity]));
        }
    }
}
