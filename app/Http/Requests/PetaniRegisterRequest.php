<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetaniRegisterRequest extends FormRequest
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
            'nik' => 'required|max:16|min:16|numeric|unique:petanis,nik',
            'nama' => 'required|max:60|min:3',
            'kata_sandi' => 'required|regex:/^[\w-]*$/',
            'foto_ktp' => 'required|max:5140|mimes:png,jpg',
            'nomor_telepon' => 'required|numeric|max:20|regex:/(01)[0-9]{9}/',
            'id_kelompok_tani' => 'required'
        ];
    }
}