<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class KiosResmiRegisterRequest extends FormRequest
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
            'nib' => 'required|numeric|digits:13|unique:kios_resmis,nib',
            'kata_sandi' => 'required|min:6',
            'nama'=> 'required',
            'jalan'=> 'required',
            'id_kecamatan' => 'required',
            'foto_ktp' => 'required|mimes:png,jpg|max:5120',
            'nik' => 'required|numeric|digits:16|unique:pemilik_kios,nik',
            'nama_pemilik' => 'required',
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
            'nib.required' => 'NIB tidak boleh kosong',
            'nib.unique' => 'NIB telah terdaftar',
            'nib.numeric' => 'NIB harus berupa angka',
            'nib.digits' => 'NIB harus berjumlah tepat 13 karakter',
            'kata_sandi.required' => 'Kata sandi tidak boleh kosong',
            'kata_sandi.min' => 'Kata sandi harus berjumlah minimal 6 karakter',
            'nama.required' => 'Nama kios tidak boleh kosong',
            'jalan.required' => 'Alamat tidak boleh kosong',
            'id_kecamatan.required' => 'Kecamatan tidak boleh kosong',
            'foto_ktp.required' => 'Foto KTP tidak boleh kosong',
            'foto_ktp.mimes' => 'Foto KTP harus berekstensi .png atau .jpg',
            'foto_ktp.max' => 'Foto KTP harus memiliki ukuran kurang dari 5MB',
            'nik.required' => 'NIK tidak boleh kosong',
            'nik.numeric' => 'NIK harus berupa angka',
            'nik.unique' => 'NIK telah terdaftar',
            'nik.digits' => 'NIK harus berjumlah tepat 16 karakter',
            'nama_pemilik.required' => 'Nama tidak boleh kosong',
            'nomor_telepon.required' => 'Nomor telepon tidak boleh kosong',
            'nomor_telepon.numeric' => 'Nomor telepon harus berupa angka',
            'nomor_telepon.unique' => 'Nomor telepon telah terdaftar',
            'nomor_telepon.between' => 'Nomor telepon harus berjumlah antara 10 hingga 13 karakter',
            'nomor_telepon.regex' => 'Nomor telepon harus berupa angka',
        ];
    }
}
