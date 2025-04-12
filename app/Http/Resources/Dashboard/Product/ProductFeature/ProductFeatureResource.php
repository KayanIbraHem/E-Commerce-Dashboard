<?php

namespace App\Http\Resources\Dashboard\Product\ProductFeature;

use App\Http\Resources\Dashboard\Product\ProductAdvantage\ProductAdvantageResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductFeatureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $title = getTranslation('title', $request->header('Accept-Language'), $this);
        return [
            'id' => $this->id ?? 0,
            'title' => $title ?? "",
            'advantages' => ProductAdvantageResource::collection($this->advantages??[])??[],
        ];
    }
}
