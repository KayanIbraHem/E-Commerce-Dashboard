<?php

namespace App\Http\Resources\Dashboard\EndPoint\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\Product\Product\ProductCategoryResource;

class SearchProductResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        $title = getTranslation('title', $request->header('Accept-Language'), $this);
        $description = getTranslation('description', $request->header('Accept-Language'), $this);

        return [
            'id' => $this->id ?? 0,
            'title' => $title ?? "",
            'description' => $description ?? "",
            'price'=>(int) $this->price ?? 0,
            'category' => new ProductCategoryResource($this->category) ?? "",

        ];
    }
}
