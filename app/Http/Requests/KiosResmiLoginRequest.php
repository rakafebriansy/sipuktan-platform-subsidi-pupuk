<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KiosResmiLoginRequest extends FormRequest
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
            'nib' => 'required|numeric',
            'kata_sandi' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nib.required' => 'NIB tidak boleh kosong',
            'nib.numeric' => 'NIB harus berupa angka',
            'kata_sandi.required' => 'Kata sandi tidak boleh kosong',
        ];
    }
}
