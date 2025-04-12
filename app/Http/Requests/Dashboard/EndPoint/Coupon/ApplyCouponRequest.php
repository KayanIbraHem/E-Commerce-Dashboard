<?php

namespace App\Http\Requests\Dashboard\EndPoint\Coupon;

use App\Rules\ExistsPerOrganizationRule;
use App\Bases\FormRequest\FormRequestBase;
use Illuminate\Foundation\Http\FormRequest;

class ApplyCouponRequest extends FormRequestBase
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
            'code' => ['required', new ExistsPerOrganizationRule(table: 'coupons', organizationId: $organizationId, targetColumn: 'code', column: __('message.code_column'))],
            // 'total_price' => ['required', 'numeric']
        ];
    }
}
