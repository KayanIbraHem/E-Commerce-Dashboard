<?php

namespace App\Http\Requests\Dashboard\Geography\City;

use App\Bases\FormRequest\FormRequestBase;
use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequestBase
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
        return [
            "title_ar" => ["required", "min:3"],
            "title_en" => ["required", "min:3"],
            "governorate_id" => 'required|exists:governorates,id'
        ];
    }
}
