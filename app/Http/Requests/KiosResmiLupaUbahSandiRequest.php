<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KiosResmiLupaUbahSandiRequest extends FormRequest
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
            'id_kios_resmi' => 'required',
            'sandi_baru' => 'required|min:6',
            'sandi_ulang' => 'required|min:6',
            'token' => 'required|exists:kios_resmis,token',
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
            'id_kios_resmi.required' => 'Kembali ke form lupa sandi',
            'token.required' => 'Token tidak boleh kosong',
            'token.exists' => 'Token tidak valid',
            'sandi_baru.required' => 'Kata sandi baru tidak boleh kosong',
            'sandi_ulang.required' => 'Ulangi kata sandi baru tidak boleh kosong',
            'sandi_baru.min' => 'Kata sandi baru harus berjumlah minimal 6 karakter',
            'sandi_ulang.min' => 'Ulangi kata sandi baru harus berjumlah minimal 6 karakter',
        ];
    }
}
