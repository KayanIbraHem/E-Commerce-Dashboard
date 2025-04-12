<?php

namespace App\Http\Resources\Dashboard\Geography\Area;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\Geography\City\CityResource;
use App\Http\Resources\Dashboard\Geography\Area\AreaCityResource;
use App\Http\Resources\Dashboard\Geography\Governorate\GovernorateResource;

class AreaResource extends JsonResource
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
            "governorate" => new GovernorateResource($this->governorate) ?? "",
            "city" => new AreaCityResource($this->city) ?? ""
        ];
    }
}
