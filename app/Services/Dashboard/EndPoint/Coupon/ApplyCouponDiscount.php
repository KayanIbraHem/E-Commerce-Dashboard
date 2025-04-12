<?php

namespace App\Services\Dashboard\EndPoint\Coupon;

use App\Enums\CouponType;
use App\Models\Cart\Cart;
use App\Models\Coupon\Coupon;
use App\Enums\CouponDiscountType;
use Illuminate\Support\Facades\DB;
use App\Services\Dashboard\EndPoint\Coupon\Product\ProductStockQuantity;
use App\Services\Dashboard\EndPoint\Coupon\Factory\CouponPriceCalculator;

class ApplyCouponDiscount
{
    public function __construct(protected CouponPriceCalculator $couponPriceCalculator) {}
    public function applyCoupon($items, Coupon $coupon)
    {
        DB::beginTransaction();
        try {
            if ($coupon->is_general === CouponType::GENERAL->value) {
                $this->applyGeneralCoupon($items, $coupon);
            } else {
                $this->applyNotGeneralCoupon($items, $coupon);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception($e->getMessage());
        }
    }

    private function applyGeneralCoupon($items, Coupon $coupon)
    {
        if ($coupon->discount_type == CouponDiscountType::FIXED->value) {
            $this->handleCartItemDiscount($items[0], $coupon);
        } else {
            foreach ($items as $item) {
                $this->handleCartItemDiscount($item,  $coupon);
            }
        }
    }

    private function applyNotGeneralCoupon($items, Coupon $coupon)
    {
        foreach ($items as $item) {
            if ($item->product->category_id === $coupon->category_id) {
                if ($coupon->discount_type === CouponDiscountType::FIXED->value) {
                    $this->handleCartItemDiscount($item,  $coupon);
                } else {
                    $this->handleCartItemDiscount($item,  $coupon);
                }
            }
        }
    }
    private function handleCartItemDiscount($item,  Coupon $coupon)
    {
        $priceAfterDiscount = $this->couponPriceCalculator->calculatePrice($item->price_after_discount, $coupon->discount_type, $coupon->discount);
        $item->update([
            'price_after_discount' => $priceAfterDiscount,
            'discount' => $coupon->discount,
        ]);
        $this->handleCouponUsedCount($coupon);
    }
    private function handleCouponUsedCount($coupon)
    {
        $coupon->update(['used_count' => $coupon->used_count + 1]);
    }
}
