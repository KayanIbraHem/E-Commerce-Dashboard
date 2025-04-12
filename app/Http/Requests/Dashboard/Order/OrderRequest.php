<?php

namespace App\Http\Requests\Dashboard\Order;

use App\Rules\ExistsPerOrganizationRule;
use App\Bases\FormRequest\FormRequestBase;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequestBase
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
            // "cart_id" => ["required", new ExistsPerOrganizationRule('carts', $organizationId, 'id', __('message.cart_column'))],
            "client_address_id" => ["required","exists:client_addresses,id"],
        ];
    }
}
