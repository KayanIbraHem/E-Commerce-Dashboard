<?php

namespace App\Http\Resources\Dashboard\EndPoint\ClientAddress;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\ClientAddress\ClientNameResource;

class FetchClientAddressesResource extends JsonResource
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
            'building_type' => $this->building_type ?? "",
            'building_name' => $this->building_name ?? "",
            'apartment_number' => (int)$this->apartment_number ?? "",
            'floor' => $this->floor ?? "",
            'street' => $this->street ?? "",
            'address' => $this->address ?? "",
            'code' => $this->code ?? "",
            'phone' => $this->phone ?? "",
            'land_mark' => $this->landmark ?? "",
        ];
    }
}
