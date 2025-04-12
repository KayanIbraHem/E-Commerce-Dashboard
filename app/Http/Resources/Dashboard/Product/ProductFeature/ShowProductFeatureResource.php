<?php

namespace App\Http\Resources\Dashboard\Product\ProductFeature;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\Product\ProductAdvantage\ProductAdvantageResource;
use App\Http\Resources\Dashboard\Product\ProductAdvantage\ShowProductAdvantageResource;

class ShowProductFeatureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $titles = getTranslationAndLocale($this?->translations, 'title');
        return [
            'id' => $this->id ?? 0,
            'titles' => $titles ?? [],
            'advantages' => ShowProductAdvantageResource::collection($this->advantages ?? []) ?? [],
        ];
    }
}
