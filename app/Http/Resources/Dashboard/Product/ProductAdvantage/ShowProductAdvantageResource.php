<?php

namespace App\Http\Resources\Dashboard\Product\ProductAdvantage;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowProductAdvantageResource extends JsonResource
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
            'price' => (int)$this->price ?? 0
        ];
    }
}
