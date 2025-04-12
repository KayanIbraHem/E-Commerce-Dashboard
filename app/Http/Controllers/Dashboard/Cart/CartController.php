<?php

namespace App\Http\Controllers\Dashboard\Cart;

use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Cart\CartRequest;
use App\Http\Resources\Dashboard\Cart\CartResource;
use App\Services\Dashboard\Cart\CartService;

class CartController extends Controller
{
    use ApiResponse;
    public function __construct(private CartService $cartService) {}
    public function addItemToCart(CartRequest $request)
    {
        try {
            $cart = $this->cartService->store(dataRequest: $request);
            return $this->dataResponse(__('message.success_create'),  new CartResource($cart), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function showCartItems()
    {
        try {
            $carts = $this->cartService->showItems();
            return $this->dataResponse("show cart items", CartResource::collection($carts), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function showCartItem($id)
    {
        try {
            $item = $this->cartService->showItem($id);
            return $this->dataResponse("show cart item", new CartResource($item), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
    public function removeItemFromCart($id)
    {
        try {
            $this->cartService->delete($id);
            return $this->successResponse(__('message.success_delete'), 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
