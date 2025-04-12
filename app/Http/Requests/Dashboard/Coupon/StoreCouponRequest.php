<?php

namespace App\Http\Requests\Dashboard\Coupon;

use App\Enums\CouponType;
use Illuminate\Validation\Rule;
use App\Enums\CouponDiscountType;
use App\Rules\ExistsPerOrganizationRule;
use App\Rules\UniquePerOrganizationRule;
use App\Bases\FormRequest\FormRequestBase;
use Illuminate\Foundation\Http\FormRequest;

class StoreCouponRequest extends FormRequestBase
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $organizationId = auth('employee')->user()->organization_id;
        return [
            "code" => ["required", new UniquePerOrganizationRule($organizationId, 'coupons', __('message.code_column'), null)],
            "discount" => "required|numeric",
            "category_id" => ['nullable', new ExistsPerOrganizationRule('categories', $organizationId, 'id', __('message.category_column'))],
            "is_general" => [
                "required_if:category_id,null",
                Rule::when(
                    fn($input) => is_null($input['category_id']),
                    ['not_in:0']
                ),
                Rule::when(
                    fn($input) => !is_null($input['category_id']),
                    ['not_in:1']
                ),
                "in:" . enumCaseValue(CouponType::class)
            ],
            "discount_type" => "required|in:" . enumCaseValue(CouponDiscountType::class),
            "min_purchase" => "required|numeric",
            "max_discount" => "required|numeric",
            "usage_limit" => "required|numeric",
            "start_date" => "required|date_format:Y-m-d|after_or_equal:today",
            "end_date" => "required|date_format:Y-m-d|after:start_date",
        ];
    }
}
