<?php

namespace App\Services\Dashboard\EndPoint\Coupon;

use Carbon\Carbon;
use App\Models\Coupon\Coupon;
use App\Factory\AuthModel\AuthModel;

class ApplyCouponService
{
    public function __construct(protected AuthModel $authModel, protected ApplyCouponDiscount $applyCouponDiscount) {}

    public function apply($request)
    {
        $coupon = $this->coupon($request->code);
        $this->checkCouponActivity($request->code);
        $cartItem = $this->authModel->getModel(getGuard())->where('id', userIdPerAuth())->first()->carts;
        $items = !$cartItem->isEmpty() ? $cartItem
            : throw new \Exception(__('message.empty_cart'));
        $this->applyCouponDiscount->applyCoupon($items, $coupon);
    }
    public function checkCouponActivity($code)
    {
        $isVaild = $this->coupon($code)->isValid();
        if (!$isVaild) {
            throw new \Exception(__('message.coupon_not_vaild'));
        }
        return true;
    }
    public function coupon($code)
    {
        return  Coupon::where('code', $code)->first();
    }
}
