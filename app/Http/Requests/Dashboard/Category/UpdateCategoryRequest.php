<?php

namespace App\Http\Requests\Dashboard\Category;

use Illuminate\Validation\Rule;
use App\Rules\UniquePerOrganizationRule;
use App\Bases\FormRequest\FormRequestBase;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequestBase
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
            "title_ar" => ["required", "min:3"],
            "title_en" => ["required", "min:3"],
            // "id_category" => [
            //     'required',
            //     Rule::unique('categories', 'id_category')
            //         ->ignore($this->category)
            //         ->where('organization_id', $organizationId)
            // ],
            "id_category" => ['required', new UniquePerOrganizationRule($organizationId, 'categories', __('message.id_category_column'), $this->category)],
            "image" => ['nullable', 'image', 'mimes:png,jpg,jpeg'],
            'sections.*.title_ar' => ['nullable', 'min:3', 'max:255'],
            'sections.*.title_en' => ['nullable', 'min:3', 'max:255'],
        ];
    }
}
