<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class KiosResmiUbahLaporanRequest extends FormRequest
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
            'id_laporan' => 'required',
            'foto_bukti_pengambilan' => 'required|mimes:png,jpg|max:5120',
            'foto_ktp' => 'required|mimes:png,jpg|max:5120',
            'foto_surat_kuasa' => 'mimes:png,jpg|max:5120',
            'foto_tanda_tangan' => 'required|mimes:png,jpg|max:5120',
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
            'foto_bukti_pengambilan.required' => 'Foto bukti pengambilan tidak boleh kosong',
            'foto_bukti_pengambilan.mimes' => 'Foto bukti pengambilan harus berekstensi .png atau .jpg',
            'foto_bukti_pengambilan.max' => 'Foto bukti pengambilan harus memiliki ukuran kurang dari 5MB',
            'foto_ktp.required' => 'Foto KTP tidak boleh kosong',
            'foto_ktp.mimes' => 'Foto KTP harus berekstensi .png atau .jpg',
            'foto_ktp.max' => 'Foto KTP harus memiliki ukuran kurang dari 5MB',
            'foto_tanda_tangan.required' => 'Foto tanda tangan tidak boleh kosong',
            'foto_tanda_tangan.mimes' => 'Foto tanda tangan harus berekstensi .png atau .jpg',
            'foto_tanda_tangan.max' => 'Foto tanda tangan harus memiliki ukuran kurang dari 5MB',
            'foto_surat_kuasa.mimes' => 'Foto surat kuasa harus berekstensi .png atau .jpg',
            'foto_surat_kuasa.max' => 'Foto surat kuasa harus memiliki ukuran kurang dari 5MB',
        ];
    }
}
