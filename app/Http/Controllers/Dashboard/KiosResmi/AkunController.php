<?php

namespace App\Http\Controllers\Dashboard\KiosResmi;

use App\Http\Controllers\Controller;
use App\Http\Requests\KiosResmiUbahNoTelpRequest;
use App\Http\Requests\KiosResmiUbahSandiRequest;
use App\Services\AkunService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class AkunController extends Controller
{
    private AkunService $akun_service;
    public function __construct(AkunService $akun_service) {
        $this->akun_service = $akun_service;
    }
    public function setUbahSandi()
    {
        return response()->view('dashboard.kios-resmi.pages.ubah-sandi', [
            'title' => 'Kios Resmi | Ubah Kata Sandi'
        ]);
    }
    public function ubahSandi(KiosResmiUbahSandiRequest $request): RedirectResponse
    {
        $id = Session::get('id_kios_resmi',null);
        $validated = $request->validated();
        if($this->akun_service->kiosResmiCekSandi($id,$validated['sandi_lama'])) {
            if($validated['sandi_baru'] == $validated['sandi_ulang']) {
                if($this->akun_service->kiosResmiUbahSandi($id,$validated['sandi_baru']))
                return redirect('/kios-resmi/dashboard')->with('success','Kata sandi berhasil diperbarui');
            }
            return back()->withErrors(['failed' => 'Konfirmasi kata sandi tidak sama']);
        }
        return back()->withErrors(['failed' => 'Kata sandi lama salah']);
    }
    public function ubahNoTelp(KiosResmiUbahNoTelpRequest $request): RedirectResponse
    {
        $id = Session::get('id_kios_resmi',null);
        $validated = $request->validated();
        if($this->akun_service->kiosResmiUbahNoTelp($id, $validated['nomor_telepon']))
        return back()->with('success','Nomor telepon berhasil diperbarui');
        return back()->withErrors(['failed' => 'Nomor telepon gagal diperbarui']);
    }
}
