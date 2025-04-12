<?php

namespace App\Http\Resources\Dashboard\Coupon;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Dashboard\Coupon\CouponCategoryResource;

class CouponResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id ?? 0,
            "code" => $this->code ?? "",
            "category_id" => new CouponCategoryResource($this->category) ?? "",
            "is_general" => (int) $this->is_general ?? "",
            "is_active" => (int) $this->is_active ?? "",
            "discount" => (int)$this->discount ?? 0,
            "discount_type" => (int) $this->discount_type ?? 0,
            "min_purchase" => (int)$this->min_purchase ?? 0,
            "max_discount" => (int)$this->max_discount ?? 0,
            "usage_limit" => (int) $this->usage_limit ?? 0,
            "used_count" => (int)$this->used_count ?? 0,
            "start_date" => Carbon::parse($this->start_date)->format('Y-m-d'),
            "end_date" => Carbon::parse($this->end_date)->format('Y-m-d')
        ];
    }
}
