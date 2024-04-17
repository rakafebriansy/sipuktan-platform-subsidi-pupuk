<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KiosResmiGantiSandiRequest extends FormRequest
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
            'sandi_lama' => 'required|min:6',
            'sandi_baru' => 'required|min:6',
            'sandi_ulang' => 'required|min:6',
        ];
    }
}
