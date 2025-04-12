<?php

namespace App\Http\Resources\Dashboard\EndPoint\GlobalSearch;


use App\Http\Resources\Dashboard\ShippingType\ShippingTypeResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GlobalSearchDriverResource extends JsonResource
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
            'name' => $this->name ?? '',
            'email' => $this->email ?? '',
            'phone' => $this->phone ?? '',
            'age' => $this->age ?? '',
        ];
    }
}
