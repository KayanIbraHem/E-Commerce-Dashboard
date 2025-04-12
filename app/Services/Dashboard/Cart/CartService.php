<?php

namespace App\Services\Dashboard\Cart;

use App\Models\Cart\Cart;
use App\Factory\AuthModel\AuthModel;
use App\Services\Dashboard\Cart\Product\ProductAvailability;

class CartService
{
    public function __construct(protected ProductAvailability $productAvailability, protected AuthModel $authModel) {}
    public function showItems()
    {
        return $this->authModel->getModel(getGuard())->where('id', userIdPerAuth())->first()->carts;
    }
    public function showItem($id)
    {
        $cartItem = $this->authModel->getModel(getGuard())->where('id', userIdPerAuth())->first()->carts;
        $item = $cartItem->find($id) ?? throw new \Exception(__('message.not_found'));
        return $item;
    }
    public function store($dataRequest)
    {
        $organizationId = organizationIdPerAuth();

        $this->productAvailability->checkProductAvailability(productId: $dataRequest->product_id, quantity: $dataRequest->quantity, organizationId: $organizationId);

        $cartItem = Cart::where([
            'product_id' => $dataRequest->product_id,
            'product_feature_id' => $dataRequest->product_feature_id,
            'product_advantage_id' => $dataRequest->product_advantage_id,
            'cartable_id' => userIdPerAuth()
        ])->first();

        if ($cartItem) {
            $this->updateCartItem($cartItem, $dataRequest);
            return $cartItem;
        }

        return $this->createCartItem($dataRequest, $organizationId);
    }
    public function delete($id)
    {
        $cartItems = $this->authModel->getModel(getGuard())->where('id', userIdPerAuth())->first()->carts;
        $item = $cartItems->find($id) ?? throw new \Exception(__('message.not_found'));
        $item->delete();
    }
    private function updateCartItem($cartItem, $dataRequest)
    {
        $newQuantity = $cartItem->quantity + $dataRequest->quantity;
        $newTotalPrice = $newQuantity * $dataRequest->price;

        $cartItem->update([
            'quantity' => $newQuantity,
            'price_after_discount' => $newTotalPrice
        ]);
    }

    private function createCartItem($dataRequest, $organizationId)
    {
        $totalPrice = $dataRequest->quantity * $dataRequest->price;

        return Cart::create([
            'organization_id' => $organizationId,
            'product_id' => $dataRequest->product_id,
            'product_feature_id' => $dataRequest->product_feature_id,
            'product_advantage_id' => $dataRequest->product_advantage_id,
            'cartable_id' => userIdPerAuth(),
            'quantity' => $dataRequest->quantity,
            'price' => $dataRequest->price,
            'price_after_discount' => $totalPrice,
        ]);
    }
}
