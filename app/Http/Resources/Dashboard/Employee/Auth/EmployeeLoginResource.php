<?php

namespace App\Http\Resources\Dashboard\Employee\Auth;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeLoginResource extends JsonResource
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
        ];
    }
}
