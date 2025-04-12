<?php

namespace App\Http\Resources\Dashboard\Product\Product;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Permission\Permission;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\Position\PositionResource;
use App\Http\Resources\Dashboard\Permission\PermissionResource;

class ProductEmployeeResource extends JsonResource
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
        ];
    }
}
