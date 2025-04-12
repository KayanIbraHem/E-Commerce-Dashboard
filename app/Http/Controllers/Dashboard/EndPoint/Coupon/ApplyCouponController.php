<?php

namespace App\Http\Controllers\Dashboard\EndPoint\Coupon;

use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\EndPoint\Coupon\ApplyCouponService;
use App\Http\Requests\Dashboard\EndPoint\Coupon\ApplyCouponRequest;

class ApplyCouponController extends Controller
{
    use ApiResponse;
    public function __construct(private ApplyCouponService $applyCouponService) {}
    public function __invoke(ApplyCouponRequest $request)
    {
        try {
            $this->applyCouponService->apply($request);
            return $this->successResponse('coupon applied successfully');
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
