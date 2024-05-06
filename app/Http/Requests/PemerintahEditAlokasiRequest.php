<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PemerintahEditAlokasiRequest extends FormRequest
{
    private array $musim_tanam = ['MT1','MT2','MT3'];
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
            'id' => 'required',
            'jumlah_pupuk' => 'required',
            'tahun' => 'required|numeric',
            'musim_tanam' => 'required|in:' . implode(',', $this->musim_tanam),
            'id_jenis_pupuk' => 'required|exists:jenis_pupuks,id',
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
            'jumlah_pupuk.required' => 'Jumlah pupuk tidak boleh kosong',
            'tahun.required' => 'Tahun tidak boleh kosong',
            'tahun.numeric' => 'Tahun harus berupa angka',
            'musim_tanam.required' => 'Musim tanam tidak boleh kosong',
            'musim_tanam.in:' . implode(',', $this->musim_tanam) => 'Musim tanam tersebut tidak tersedia',
            'id_jenis_pupuk.required' => 'Jenis pupuk tidak boleh kosong',
            'id_jenis_pupuk.exists:jenis_pupuks,id' => 'Jenis pupuk tersebut tidak tersedia',
        ];
    }
}
