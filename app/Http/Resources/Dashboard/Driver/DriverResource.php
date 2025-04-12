<?php

namespace App\Http\Resources\Dashboard\Driver;

use App\Http\Resources\Dashboard\ShippingType\ShippingTypeResource;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DriverResource extends JsonResource
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
            'status' => $this->status ?? '',
            'date_of_birth' => Carbon::parse($this->date_of_birth)->format('Y-m-d') ?? "",
            'date_of_employment' => Carbon::parse($this->date_of_employment)->format('Y-m-d') ?? "",
            'image' => $this->imageLink ?? '',
            'front_side_image' => $this->frontSideImageLink ?? '',
            'back_side_image' => $this->backSideImageLink ?? '',
            'license_image' => $this->licenseImageLink ?? '',
            'driver_license_image' => $this->driverLicenseImageLink ?? '',
            "shipping_type" => new ShippingTypeResource($this->shippingType) ?? ""
        ];
    }
}
