<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PetaniRegisterRequest extends FormRequest
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
            'nik' => 'required|numeric|unique:petanis,nik|digits:16',
            'nama' => 'required|max:60',
            'kata_sandi' => 'required|min:6',
            'foto_ktp' => 'required|mimes:png,jpg|max:5120',
            'nomor_telepon' => 'required|unique:petanis,nomor_telepon|string|min:10|max:13|regex:/^[0-9]{10,13}$/',
            'id_kelompok_tani' => 'required'
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
            'nik.required' => 'NIK tidak boleh kosong',
            'nik.numeric' => 'NIK harus berupa angka',
            'nik.unique' => 'NIK telah terdaftar',
            'nik.digits' => 'NIK harus berjumlah tepat 16 karakter',
            'nama.required' => 'Nama tidak boleh kosong',
            'kata_sandi.required' => 'Kata sandi tidak boleh kosong',
            'kata_sandi.min' => 'Kata sandi harus berjumlah minimal 6 karakter',
            'foto_ktp.required' => 'Foto KTP tidak boleh kosong',
            'foto_ktp.mimes' => 'Foto KTP harus berekstensi .png atau .jpg',
            'foto_ktp.max' => 'Foto KTP harus memiliki ukuran kurang dari 5MB',
            'nomor_telepon.required' => 'Nomor telepon tidak boleh kosong',
            'nomor_telepon.regex' => 'Nomor telepon harus berupa angka',
            'nomor_telepon.unique' => 'Nomor telepon telah terdaftar',
            'nomor_telepon.min' => 'Nomor telepon harus berjumlah minimal 10 karakter',
            'nomor_telepon.max' => 'Nomor telepon harus berjumlah maksimal 13 karakter',
            'id_kelompok_tani.required' => 'Kelompok tani tidak boleh kosong'
        ];
    }
}