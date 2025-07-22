<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseRequest extends FormRequest
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
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
   */
  public function rules(): array
  {
    return [];
  }

  /**
   * Handle a failed validation attempt.
   *
   * @param Validator $validator
   * @throws HttpResponseException
   */
  protected function failedValidation(Validator $validator)
  {

    
    $errors = collect($validator->errors()->toArray())
      ->mapWithKeys(function ($messages, $field) {
        return [$field => $messages[0]]; // Use the first error message for each field
      })
      ->toArray();


    $response = response()->json([
      'status_code' => 422,
      'message' => 'Validation Failed',
      'errors' => $errors,
    ], 422);

    throw new HttpResponseException($response);
  }
}