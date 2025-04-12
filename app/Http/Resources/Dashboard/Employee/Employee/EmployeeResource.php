<?php

namespace App\Http\Resources\Dashboard\Employee\Employee;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Permission\Permission;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\Position\PositionResource;
use App\Http\Resources\Dashboard\Permission\PermissionResource;

class EmployeeResource extends JsonResource
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
            'image' => $this->imageLink ?? '',
            'date_added' => Carbon::parse($this->date_added)->format('Y-m-d'),
            'api_token' => $this->api_token ?? '',
            'position' => new PositionResource($this->position) ?? "",
            'permission' => new PermissionResource($this?->permission) ?? "",
            'added_by' => new EmployeeNameResource($this->employee) ?? ""
        ];
    }
}
