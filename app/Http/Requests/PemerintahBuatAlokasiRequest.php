<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PemerintahBuatAlokasiRequest extends FormRequest
{
    private array $musim_tanam = ['MT1','MT2','MT3'];
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::guard('pemerintah')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nik' => 'required|numeric|min:16',
            'jumlah_pupuk' => 'required',
            'tahun' => 'required|numeric|digits:4',
            'id_jenis_pupuk' => 'required|exists:jenis_pupuks,id',
            'musim_tanam' => 'required|in:' . implode(',', $this->musim_tanam),
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
            'nik.required' => 'NIK tidak boleh kosong',
            'nik.numeric' => 'NIK harus berupa angka',
            'nik.min' => 'NIK harus harus berjumlah minimal 16 karakter',
            'jumlah_pupuk.required' => 'Jumlah pupuk tidak boleh kosong',
            'tahun.required' => 'Tahun tidak boleh kosong',
            'tahun.numeric' => 'Tahun harus berupa angka',
            'tahun.digits' => 'Tahun tidak valid',
            'id_jenis_pupuk.required' => 'Jenis pupuk tidak boleh kosong',
            'id_jenis_pupuk.exists' => 'Jenis pupuk tersebut tidak tersedia',
            'musim_tanam.required' => 'Musim tanam tidak boleh kosong',
            'musim_tanam.in' => 'Musim tanam tersebut tidak tersedia',
        ];
    }
}
