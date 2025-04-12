<?php

namespace App\Http\Controllers\Dashboard\Order;

use Illuminate\Http\Request;
use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\General\Order\OrderService;
use App\Http\Requests\Dashboard\Order\OrderRequest;
use App\Http\Resources\Dashboard\Order\OrderResource;

class OrderController extends Controller
{
    use ApiResponse;
    public function __construct(private OrderService $orderService) {}
    // public function index()
    // {
    //     try {
    //         $orders = $this->orderService->index();
    //         $response = OrderResource::collection($orders)->response()->getData(true);
    //         return $this->dataResponse('fetch all orders', $response, 200);
    //     } catch (\Exception $e) {
    //         return $this->returnException($e->getMessage(), 500);
    //     }
    // }
    // public function show(int $id)
    // {
    //     try {
    //         $row = $this->orderService->show($id);
    //         $response = new OrderResource($row);
    //         return $this->dataResponse('show coupon', $response, 200);
    //     } catch (\Exception $e) {
    //         return $this->returnException($e->getMessage(), 500);
    //     }
    // }
    public function store(OrderRequest $request)
    {
        try {
            $order = $this->orderService->store(dataRequest: $request);
            return $this->dataResponse(__('message.success_create'),  new OrderResource($order), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    // public function update(UpdateCouponRequest $request, int $id)
    // {
    //     try {
    //         $coupon = $this->orderService->update(dataRequest: $request->validated(), id: $id);
    //         return $this->dataResponse(__('message.success_update'),  new OrderResource($coupon), 200);
    //     } catch (\Exception $e) {
    //         return $this->returnException($e->getMessage(), 500);
    //     }
    // }
    // public function delete($id)
    // {
    //     try {
    //         $this->orderService->delete($id);
    //         $msg = __('message.success_delete');
    //         return $this->successResponse($msg, 200);
    //     } catch (\Exception $e) {
    //         return $this->returnException($e->getMessage(), 500);
    //     }
    // }
}
