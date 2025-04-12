<?php

namespace App\Http\Requests\Dashboard\Cart;

use Illuminate\Validation\Rule;
use App\Rules\ExistsPerOrganizationRule;
use App\Bases\FormRequest\FormRequestBase;
use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequestBase
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
        $organizationId = organizationIdPerAuth();
        return [
            "product_id" => ['required', new ExistsPerOrganizationRule('products', $organizationId, 'id', __('message.product_column'))],
            "product_feature_id" => [
                'nullable',
                Rule::exists('product_features', 'id')
                    ->where('product_id', $this->product_id)
            ],
            "product_advantage_id" => [
                'nullable',
                Rule::exists('product_advantages', 'id')
                    ->where('product_feature_id', $this->product_feature_id)
            ],
            "quantity" => "nullable|numeric",
            "price" => "nullable|numeric",
            "total_price" => "nullable|numeric",
        ];
    }
}
