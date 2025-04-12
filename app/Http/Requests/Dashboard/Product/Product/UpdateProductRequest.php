<?php

namespace App\Http\Requests\Dashboard\Product\Product;

use App\Bases\FormRequest\FormRequestBase;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequestBase
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
            "description_ar" => ["required", "min:3"],
            "description_en" => ["required", "min:3"],
            "quantity" => ["required", "numeric"],
            "discount_type" => ["required", "in:0,1,2"],
            "discount_value" => ["required", "numeric"],
            "price" => ["required", "numeric"],
            "main_image" => ["nullable", "image", "mimes:png,jpg,jpeg"],
            "video" => ["nullable", "mimes:mp4,ogx,oga,ogv,ogg,webm"],
            "category_id" => ["nullable", "exists:categories,id"],
            "images" => ["nullable", "array"],
            "images.*" => ["image", "mimes:png,jpg,jpeg"],
            "product_features" => ["nullable", "array"],
            "product_features.*.title_ar" => ["nullable", "min:3"],
            "product_features.*.title_en" => ["nullable", "min:3"],
            "product_features.*.product_advantages" => ["nullable", "array"],
            "product_features.*.product_advantages.*.title_ar" => ["required", "min:3"],
            "product_features.*.product_advantages.*.title_en" => ["required", "min:3"],
            "product_features.*.product_advantages.*.price" => ["nullable", "numeric"],
        ];
    }
}
