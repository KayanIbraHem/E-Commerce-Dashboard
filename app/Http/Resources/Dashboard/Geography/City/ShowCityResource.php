<?php

namespace App\Http\Resources\Dashboard\Geography\City;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\Geography\Governorate\ShowGovernorateResource;

class ShowCityResource extends JsonResource
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
            "governorate" => new ShowGovernorateResource($this->governorate) ?? ""
        ];
    }
}
