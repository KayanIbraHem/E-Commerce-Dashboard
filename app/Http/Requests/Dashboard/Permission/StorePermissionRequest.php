<?php

namespace App\Http\Requests\Dashboard\Permission;

use App\Bases\FormRequest\FormRequestBase;
use Illuminate\Foundation\Http\FormRequest;

class StorePermissionRequest extends FormRequestBase
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

        $rules = [
            'title_ar' => ['required', 'min:3', 'max:255'],
            'title_en' => ['required', 'min:3', 'max:255'],
            'details' => ['nullable', 'array'],
            'details.*.title_ar' => ['nullable', 'min:3', 'max:255'],
            'details.*.title_en' => ['nullable', 'min:3', 'max:255'],
        ];

        // if($this->method() == "PUT"){

        //     $rules['title_ar'] = ['sometimes', 'min:3', 'max:255'];
        //     $rules['title_en'] = ['sometimes', 'min:3', 'max:255'];
        //     $rules['details'] = ['sometimes', 'array'];
        //     $rules['details.*.title_ar'] = ['sometimes', 'min:3', 'max:255'];
        //     $rules['details.*.title_en'] = ['sometimes', 'min:3', 'max:255'];
        // }

        return $rules;
    }
}
