<?php

namespace App\Http\Requests\Dashboard\ClientAddress;

use App\Bases\FormRequest\FormRequestBase;
use App\Enums\BuildingType;
use Illuminate\Foundation\Http\FormRequest;

class ClientAddressRequest extends FormRequestBase
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
            "client_id" => "required|exists:clients,id",
            "building_type" => "required|in:" . enumCaseValue(BuildingType::class),
            "building_name" => "required",
            "apartment_number" => "required",
            "floor" => "nullable",
            "street" => "required",
            "address" => "required",
            "code" => "required|numeric",
            "phone" => "required|numeric",
            "landmark" => "required",
        ];
    }
}
