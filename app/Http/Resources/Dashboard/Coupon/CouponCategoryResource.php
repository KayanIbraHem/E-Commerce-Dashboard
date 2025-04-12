<?php

namespace App\Http\Resources\Dashboard\Coupon;


use App\Http\Resources\Dashboard\Section\CategorySectionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponCategoryResource extends JsonResource
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
        ];
    }
}
