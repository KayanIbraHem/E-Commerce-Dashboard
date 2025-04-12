<?php

namespace App\Services\General\Order;

use Carbon\Carbon;
use App\Models\Order\Order;
use App\Models\Order\OrderItem;
use Illuminate\Support\Facades\DB;
use App\Factory\AuthModel\AuthModel;
use App\Services\Dashboard\EndPoint\Coupon\Product\ProductStockQuantity;

class OrderService
{
    public function __construct(protected AuthModel $authModel, protected ProductStockQuantity $productStockQuantity) {}

    public function store($dataRequest)
    {
        DB::beginTransaction();
        try {
            $orderNumber = str_replace(['-', ':', ' '], '', date('Y-m-d H:i:s'));
            $organizationId = organizationIdPerAuth();
            $ClientAddressId = $dataRequest->client_address_id;
            $cartItem = $this->authModel->getModel(getGuard())->where('id', userIdPerAuth())->first()->carts;
            $items = !$cartItem->isEmpty() ? $cartItem
                : throw new \Exception(__('message.empty_cart'));
            $order = $this->createOrder($organizationId, $ClientAddressId, $orderNumber, $items);
            $this->createOrderItems($order, $items);
            DB::commit();
            return $order;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception(__('message.order_creation_failed') . ': ' . $e->getMessage());
        }
    }

    private function createOrder($organizationId, $clientAddressId, $orderNumber, $items)
    {
        $calculatePrice = $this->calculatePriceDetails($items);
        return Order::create([
            'organization_id' => $organizationId,
            'client_address_id' => $clientAddressId,
            'order_number' => $orderNumber,
            'price' => $calculatePrice['price'],
            'discount' => $calculatePrice['discount'],
            'price_after_discount' => $calculatePrice['price_after_discount'],
        ]);
    }
    private function createOrderItems($order, $items)
    {
        foreach ($items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_feature_id' => $item->product_feature_id,
                'product_advantage_id' => $item->product_advantage_id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'discount' => $item->discount,
                'price_after_discount' => $item->price_after_discount,
            ]);
            $this->productStockQuantity->updateStock($item->product_id, $item->quantity);
            $item->delete();
        }
    }
    private function calculatePriceDetails($items)
    {
        $price = 0;
        $discount = 0;
        $priceAfterDiscount = 0;

        foreach ($items as $item) {
            $price += $item->price * $item->quantity;
            $discount += $item->discount;
            $priceAfterDiscount += $item->price_after_discount;
        }

        return [
            'price' => $price,
            'discount' => $discount,
            'price_after_discount' => $priceAfterDiscount
        ];
    }
}
