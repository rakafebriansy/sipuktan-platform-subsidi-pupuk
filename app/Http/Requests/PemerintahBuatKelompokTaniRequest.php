<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PemerintahBuatKelompokTaniRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::guard('pemerintah')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|max:60',
            'id_kios_resmi' => 'required|exists:kios_resmis,id',
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
            'nama.required' => 'Nama tidak boleh kosong',
            'nama.max' => 'Nama berjumlah maksimal 60 karakter',
            'id_kios_resmi.required' => 'Kios resmi tidak boleh kosong',
            'id_kios_resmi.exists' => 'Kios resmi tidak tersedia',
        ];
    }
}
