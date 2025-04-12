<?php

namespace App\Http\Requests\Dashboard\Driver;

use App\Rules\UniquePerOrganizationRule;
use App\Bases\FormRequest\FormRequestBase;
use Illuminate\Foundation\Http\FormRequest;

class StoreDriverRequest extends FormRequestBase
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', new UniquePerOrganizationRule($organizationId, 'drivers', __('message.email_column'))],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'max:255', new UniquePerOrganizationRule($organizationId, 'drivers', __('message.phone_column'))],
            'age' => ['nullable', 'numeric', 'max:255'],
            'shipping_type_id' => ['nullable', 'exists:shipping_types,id'],
            'date_of_birth' => ['nullable', 'date', 'date_format:Y-m-d'],
            'date_of_employment' => ['nullable', 'date', 'date_format:Y-m-d'],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg'],
            'front_side_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg'],
            'back_side_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg'],
            'license_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg'],
            'driver_license_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg'],
        ];
    }
}
