<?php

namespace App\Http\Resources\Dashboard\Product\Product;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\Product\Product\ProductCategoryResource;
use App\Http\Resources\Dashboard\Product\ProductFeature\ProductFeatureResource;
use App\Http\Resources\Dashboard\Product\ProductFeature\ShowProductFeatureResource;

class ShowProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $titles = getTranslationAndLocale($this?->translations, 'title');
        $descriptions = getTranslationAndLocale($this?->translations, 'description');

        $images = $this->images->map(function ($image) {
            return $image->imageLink ?? "";
        })->toArray();

        return [
            'id' => $this->id ?? 0,
            'titles' => $titles ?? [],
            'descriptions' => $descriptions ?? [],
            'status' => (int) $this->status ?? 0,
            'main_image' => $this->mainImageLink ?? "",
            'images' => $images,
            'price' => (int) $this->price ?? 0,
            'quantity' => (int) $this->quantity ?? 0,
            'quantity_after_purchase' => (int) $this->quantity_after_purchase ?? 0,
            'order_count' => 0,
            "created_date" =>  Carbon::parse($this->created_at)->format('Y-m-d'),
            "created_time" =>  Carbon::parse($this->created_at)->format('H:i'),
            'category' => new ProductCategoryResource($this->category) ?? "",
            'added_by' => new ProductEmployeeResource($this->employee) ?? "",
            'features' => ShowProductFeatureResource::collection($this->features ?? []) ?? []
        ];
    }
}
