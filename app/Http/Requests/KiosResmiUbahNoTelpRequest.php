<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class KiosResmiUbahNoTelpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::guard('kiosResmi')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nomor_telepon' => 'required|unique:petanis,nomor_telepon|string|min:10|max:13|regex:/^[0-9]{10,13}$/',
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
            'nomor_telepon.unique' => 'Nomor telepon telah terdaftar',
            'nomor_telepon.min' => 'Nomor telepon harus berjumlah minimal 10 karakter',
            'nomor_telepon.max' => 'Nomor telepon harus berjumlah maksimal 13 karakter',
            'nomor_telepon.regex' => 'Nomor telepon harus berupa angka',
        ];
    }
}
