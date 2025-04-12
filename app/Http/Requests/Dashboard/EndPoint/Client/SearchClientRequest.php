<?php

namespace App\Http\Requests\Dashboard\EndPoint\Client;

use App\Bases\FormRequest\FormRequestBase;
use Illuminate\Foundation\Http\FormRequest;

class SearchClientRequest extends FormRequestBase
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
            "id" => ['nullable', 'required_without:word'],
            "word" => ['nullable', 'required_without:id'],
        ];
    }
    public function messages()
    {
        return [
            "id.required_without" => __('message.id_or_word_required'),
            "word.required_without" => __('message.id_or_word_required'),
        ];
    }
}
