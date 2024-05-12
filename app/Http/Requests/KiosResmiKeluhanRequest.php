<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class KiosResmiKeluhanRequest extends FormRequest
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
            'subjek' => 'required|max:60',
            'keluhan' => 'required',
            'id_kios_resmi' => 'required'
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
            'subjek.required' => 'Subjek tidak boleh kosong',
            'subjek.max' => 'Subjek harus berjumlah maksimal 60 karakter',
            'keluhan.required' => 'Keluhan tidak boleh kosong',
        ];
    }
}
