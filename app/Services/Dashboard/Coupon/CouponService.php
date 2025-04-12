<?php

namespace App\Services\Dashboard\Coupon;

use App\Bases\CrudOperation\CrudOperationBase;

class CouponService extends CrudOperationBase
{
    protected string $model = 'App\\Models\\Coupon\\Coupon';
}
