<?php

namespace App\Http\Resources\Dashboard\Employee\Employee;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Permission\Permission;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\Position\PositionResource;
use App\Http\Resources\Dashboard\Permission\PermissionResource;

class EmployeeNameResource extends JsonResource
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
