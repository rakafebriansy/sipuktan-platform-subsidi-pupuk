<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KiosResmiLupaSandiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nomor_telepon' => 'required|numeric|exists:pemilik_kios,nomor_telepon'
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
            'nomor_telepon.required' => 'Nomor telepon tidak boleh kosong',
            'nomor_telepon.numeric' => 'Nomor telepon harus berupa angka',
            'nomor_telepon.exists' => 'Nomor telepon tidak terdaftar',
        ];
    }
}
