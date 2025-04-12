<?php

namespace App\Http\Requests\Dashboard\Employee\Profile;

use Illuminate\Validation\Rule;
use App\Rules\UniquePerOrganizationRule;
use App\Bases\FormRequest\FormRequestBase;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeProfileRequest extends FormRequestBase
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
        $employeeId = auth('employee')->user()->id;
        return [
            'name' => ['required', 'string', 'max:255'],
            // 'email' => [
            //     'required',
            //     'string',
            //     'email',
            //     'max:255',
            //     Rule::unique('organization_employees', 'email')
            //         ->ignore($this->employee)
            //         ->where('organization_id', $organizationId),
            // ],
            // 'phone' => [
            //     'required',
            //     'string',
            //     'max:255',
            //     Rule::unique('organization_employees', 'phone')
            //         ->ignore($this->employee)
            //         ->where('organization_id', $organizationId),
            // ],
            'email' => ['required', 'string', 'email', 'max:255', new UniquePerOrganizationRule($organizationId, 'organization_employees', __('message.email_column'), $employeeId)],
            'phone' => ['required', 'string', 'max:255', new UniquePerOrganizationRule($organizationId, 'organization_employees', __('message.phone_column'), $employeeId)],

            'image' => ['nullable', 'image', 'mimes:png,jpg,jpeg'],
            'position_id' => ['nullable', 'exists:positions,id'],
            'permission_id' => ['nullable', 'exists:permissions,id'],
            'date_added' => ['nullable', 'date']
        ];
    }
}
