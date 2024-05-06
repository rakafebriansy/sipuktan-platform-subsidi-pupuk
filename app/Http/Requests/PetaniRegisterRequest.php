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
            'nik' => 'required|min:16|numeric|unique:petanis,nik',
            'nama' => 'required|max:60',
            'kata_sandi' => 'required|min:6',
            'foto_ktp' => 'required|mimes:png,jpg|max:5120',
            'nomor_telepon' => 'required|numeric',
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
            'nik.unique:petanis,nik' => 'NIK telah terdaftar',
            'nik.min:16' => 'NIK harus berjumlah minimal 16 karakter',
            'nama.required' => 'Nama tidak boleh kosong',
            'nik.max:60' => 'Nama harus harus berjumlah maksimal 60 karakter',
            'kata_sandi.required' => 'Kata sandi tidak boleh kosong',
            'kata_sandi.min:6' => 'Kata sandi harus berjumlah minimal 6 karakter',
            'foto_ktp.required' => 'Foto KTP tidak boleh kosong',
            'foto_ktp.mimes:png,jpg' => 'Foto KTP harus berekstensi .png atau .jpg',
            'foto_ktp.max:5120' => 'Foto KTP harus memiliki ukuran kurang dari 5MB',
            'nomor_telepon.required' => 'Nomor telepon tidak boleh kosong',
            'nomor_telepon.numeric' => 'Nomor telepon harus berupa angka',
            'id_kelompok_tani.required' => 'Kelompok tani tidak boleh kosong'
        ];
    }
}