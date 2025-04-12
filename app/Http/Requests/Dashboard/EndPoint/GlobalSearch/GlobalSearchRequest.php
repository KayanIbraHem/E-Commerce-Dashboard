<?php

namespace App\Http\Requests\Dashboard\EndPoint\GlobalSearch;

use App\Bases\FormRequest\FormRequestBase;
use Illuminate\Foundation\Http\FormRequest;

class GlobalSearchRequest extends FormRequestBase
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            // "id" => ['nullable', 'required_without:word'],
            // "word" => ['nullable', 'required_without:id'],
            "word" => ['required'],
        ];
    }
    public function messages()
    {
        return [
            // "id.required_without" => __('message.id_or_word_required'),
            // "word.required_without" => __('message.id_or_word_required'),
            "word.required" => __('message.global_search_required'),
        ];
    }
}
