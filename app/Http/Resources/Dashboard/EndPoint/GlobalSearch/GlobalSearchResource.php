<?php

namespace App\Http\Resources\Dashboard\EndPoint\GlobalSearch;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\EndPoint\GlobalSearch\GlobalSearchEmployeeResource;

class GlobalSearchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'employees' => GlobalSearchEmployeeResource::collection($this['employees']) ?? [],
            'drivers' => GlobalSearchDriverResource::collection($this['drivers']) ?? [],
            'clients' => GlobalSearchClientResource::collection($this['clients']) ?? []
        ];
    }
}
