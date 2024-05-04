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
            'nik' => ['required','min:16','numeric','unique:petanis,nik'],
            'nama' => ['required','max:60','min:3'],
            'kata_sandi' => ['required','min:6'],
            'foto_ktp' => ['required','mimes:png,jpg','max:5140'],
            'nomor_telepon' => ['required','numeric'],
            'id_kelompok_tani' => 'required'
        ];
    }
}