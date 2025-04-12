<?php

namespace App\Bases\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

use function response;

abstract class FormRequestBase extends FormRequest
{
    abstract public function authorize();
    abstract public function rules();

    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(
            response()->json(
                [
                    'status' => false,
                    'message' => $validator->errors()->first()
                ],
                JsonResponse::HTTP_BAD_REQUEST
            )
        );
    }
}
