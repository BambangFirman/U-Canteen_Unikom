<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'username' => 'required',
            'password' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
          'username.required' => 'Username Tidak Boleh Kosong!',
          'password.required' => 'Password Tidak Boleh Kosong!',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'username' => trim($this->username),
            'password' => trim($this->password)
        ]);
    }
}
