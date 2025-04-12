<?php

namespace App\Http\Requests\Dashboard\PermissionDetail;

use App\Bases\FormRequest\FormRequestBase;
use Illuminate\Foundation\Http\FormRequest;

class PermissionDetailRequest extends FormRequestBase
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
           'permission_id' => ['required', 'exists:permissions,id'],
           'titles' => ['required','array'],
           'titles.*.title_ar' => ['required', 'min:3', 'max:255'],
           'titles.*.title_en' => ['required', 'min:3', 'max:255'],
       ];

        if($this->method() == "PUT"){

            $rules['permission_id'] = ['required', 'exists:permissions,id'];
            $rules['titles'] = ['sometimes','array'];
            $rules['titles.*.title_ar'] = ['sometimes', 'min:3', 'max:255'];
            $rules['titles.*.title_en'] = ['sometimes', 'min:3', 'max:255'];

        }

        return $rules;
    }
}
