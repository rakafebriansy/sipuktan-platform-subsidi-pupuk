<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KiosResmiLaporanRequest extends FormRequest
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
            'id_riwayat_transaksi' => 'required',
            'foto_bukti_pengambilan' => 'required|mimes:png,jpg|max:5120',
            'foto_ktp' => 'required|mimes:png,jpg|max:5120',
            'foto_surat_kuasa' => 'required|mimes:png,jpg|max:5120',
            'foto_tanda_tangan' => 'required|mimes:png,jpg|max:5120',
        ];
    }
}
