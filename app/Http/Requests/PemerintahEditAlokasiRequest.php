<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PemerintahEditAlokasiRequest extends FormRequest
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
            "id" => "required",
            "nik" => ['required','min:16','numeric','min:16'],
            "jumlah_pupuk" => "required",
            "tahun" => "required",
            "id_jenis_pupuk" => "required",
            "musim_tanam" => "required",
        ];
    }
}
