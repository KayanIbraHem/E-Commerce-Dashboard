<?php

namespace App\Http\Resources\Dashboard\Product\Product;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\Product\Product\ProductCategoryResource;
use App\Http\Resources\Dashboard\Product\ProductFeature\ProductFeatureResource;

class ProductDetailsResource extends JsonResource
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

        $images = $this->images->map(function ($image) {
            return $image->imageLink ?? "";
        })->toArray();

        $order_count = 0;
        $total_profit = max($this->price_after_discount * $order_count, 0);

        return [
            'id' => $this->id ?? 0,
            'title' => $title ?? "",
            'description' => $description ?? "",
            'status' => (int) $this->status ?? 0,
            'main_image' => $this->mainImageLink ?? "",
            'video' => $this->videoLink ?? "",
            'images' => $images,
            'discount_type' => (int) $this->discount_type ?? 0,
            'discount_value' => (int) $this->discount_value ?? 0,
            'price' => (int) $this->price ?? 0,
            'total_profit' => $total_profit ?? 0,
            'quantity' => (int) $this->quantity ?? 0,
            'quantity_after_purchase' => (int) $this->quantity_after_purchase ?? 0,
            'order_count' => $order_count,
            "created_date" =>  Carbon::parse($this->created_at)->format('Y-m-d'),
            "created_time" =>  Carbon::parse($this->created_at)->format('H:i'),
            'category' => new ProductCategoryResource($this->category) ?? "",
            'added_by' => new ProductEmployeeResource($this->employee) ?? "",
            'features' => ProductFeatureResource::collection($this->features ?? []) ?? []
        ];
    }
}
