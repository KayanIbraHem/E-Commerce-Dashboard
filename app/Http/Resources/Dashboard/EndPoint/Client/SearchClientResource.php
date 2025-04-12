<?php

namespace App\Http\Resources\Dashboard\EndPoint\Client;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SearchClientResource extends JsonResource
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
            'name' => $this->name ?? "",
        ];
    }
}
