<?php

namespace App\Http\Requests\Dashboard\Employee\Employee;

use App\Rules\UniquePerOrganizationRule;
use App\Bases\FormRequest\FormRequestBase;
use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequestBase
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
            'email' => ['required', 'string', 'email', 'max:255', new UniquePerOrganizationRule($organizationId, 'organization_employees', __('message.email_column'))],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => ['required', 'string', 'max:255', new UniquePerOrganizationRule($organizationId, 'organization_employees', __('message.phone_column'))],
            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg'],
            'position_id' => ['nullable', 'exists:positions,id'],
            'permission_id' => ['nullable', 'exists:permissions,id'],
            'date_added' => ['nullable', 'date', 'date_format:Y-m-d']
        ];
    }
}
