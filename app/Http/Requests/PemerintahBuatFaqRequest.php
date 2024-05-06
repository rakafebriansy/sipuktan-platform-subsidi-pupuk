<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PemerintahBuatFaqRequest extends FormRequest
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
            'pertanyaan' => 'required',
            'jawaban' => 'required',
            'jenis_pengguna' => 'required'
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
            'pertanyaan.required' => 'Pertanyaan tidak boleh kosong',
            'jawaban.required' => 'Jawaban tidak boleh kosong',
            'jenis_pengguna.required' => 'Jenis pengguna tidak boleh kosong',
        ];
    }
}
