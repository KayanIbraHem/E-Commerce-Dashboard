<?php

namespace App\Http\Controllers\Dashboard\Coupon;

use Illuminate\Http\Request;
use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\Coupon\CouponService;
use App\Http\Resources\Dashboard\Coupon\CouponResource;
use App\Http\Requests\Dashboard\Coupon\StoreCouponRequest;
use App\Http\Requests\Dashboard\Coupon\UpdateCouponRequest;

class CouponController extends Controller
{
    use ApiResponse;
    public function __construct(private CouponService $couponService) {}
    public function index()
    {
        try {
            $coupons = $this->couponService->index();
            $response = CouponResource::collection($coupons)->response()->getData(true);
            return $this->dataResponse('fetch all coupons', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function show(int $id)
    {
        try {
            $row = $this->couponService->show($id);
            $response = new CouponResource($row);
            return $this->dataResponse('show coupon', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function store(StoreCouponRequest $request)
    {
        try {
            $coupon = $this->couponService->store(dataRequest: $request->validated());
            return $this->dataResponse(__('message.success_create'),  new CouponResource($coupon), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function update(UpdateCouponRequest $request, int $id)
    {
        try {
            $coupon = $this->couponService->update(dataRequest: $request->validated(), id: $id);
            return $this->dataResponse(__('message.success_update'),  new CouponResource($coupon), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function delete($id)
    {
        try {
            $this->couponService->delete($id);
            $msg = __('message.success_delete');
            return $this->successResponse($msg, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
