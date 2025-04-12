<?php

namespace App\Http\Resources\Dashboard\Cart;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\Cart\CartProductResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id ?? 0,
            'product' => new CartProductResource($this->product??"") ?? "",
            'total_price' => (int) $this->price_after_discount ?? 0,
            'quantity' => (int) $this->quantity ?? 0,
            "created_date" =>  Carbon::parse($this->created_at)->format('Y-m-d'),
            "created_time" =>  Carbon::parse($this->created_at)->format('H:i'),

        ];
    }
}
