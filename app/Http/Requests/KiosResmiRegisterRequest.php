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
            'nib' => ['required','numeric','min:13'],
            'kata_sandi' => ['required','min:6'],
            'nama'=> 'required',
            'jalan'=> 'required',
            'id_kecamatan' => 'required',
            'foto_ktp' => 'required',
            'nik' => 'required',
            'nama_pemilik' => 'required',
            'nomor_telepon' => 'required',
        ];
    }
}
