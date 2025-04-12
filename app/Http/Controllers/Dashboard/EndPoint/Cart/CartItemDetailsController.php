<?php

namespace App\Http\Controllers\Dashboard\EndPoint\Cart;

use App\Bases\Trait\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Dashboard\EndPoint\Cart\CartItemDetailsService;
use App\Http\Resources\Dashboard\EndPoint\Cart\CartItemDetailsResource;

class CartItemDetailsController extends Controller
{
    use ApiResponse;
    public function __construct(private CartItemDetailsService $cartItemDetailsService) {}
    public function __invoke(int $id)
    {
        try {
            $row = $this->cartItemDetailsService->cartItemDetails($id);
            $response = new CartItemDetailsResource($row);
            return $this->dataResponse('cart item details', $response, 200);
        } catch (\Exception $e) {
            return $this->returnException($e->getMessage(), 500);
        }
    }
}
