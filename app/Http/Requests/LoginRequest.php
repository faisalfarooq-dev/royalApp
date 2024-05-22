<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
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
            'email' => ['email', 'string', 'max:255', 'required'],
            'password' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * @param Validator $validator
     * @return mixed
     */
    public function failedValidation(Validator $validator): mixed
    {
        $error = $validator->errors()->first();
        throw new HttpResponseException(redirect()->to('/')->with('error', $error));
    }
}
