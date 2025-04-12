<?php

namespace App\Http\Resources\Dashboard\Product\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\Product\Product\ProductCategoryResource;
use Carbon\Carbon;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $title = getTranslation('title', $request->header('Accept-Language'), $this);
        $description = getTranslation('description', $request->header('Accept-Language'), $this);

        return [
            'id' => $this->id ?? 0,
            'title' => $title ?? "",
            'description' => $description ?? "",
            'main_image' => $this->mainImageLink ?? "",
            'price' => (int) $this->price ?? 0,
            'status' => (int) $this->status ?? 0,
            'quantity' => (int) $this->quantity ?? 0,
            'quantity_purchase' => (int) $this->quantity_purchase ?? 0,
            'order_count' => 0,
            "created_date" =>  Carbon::parse($this->created_at)->format('Y-m-d'),
            "created_time" =>  Carbon::parse($this->created_at)->format('H:i'),
            'category' => new ProductCategoryResource($this->category) ?? "",
            'added_by' => new ProductEmployeeResource($this->employee) ?? "",
        ];
    }
}
