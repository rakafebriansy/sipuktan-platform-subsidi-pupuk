<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PemerintahRegisterRequest extends FormRequest
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
            
        ];
    }
}
return [
    'nib' => 'required|max:13|min:13|numeric|unique:kios_resmis,nib',
    'nama' => 'required|max:60|min:3',
    'jalan'=> 'required|min:5',
    'kata_sandi' => 'required|regex:/^[\w-]*$/',
    'id_pemilik_kios' => 'required',
    'id_kecamatan' => 'required',
];