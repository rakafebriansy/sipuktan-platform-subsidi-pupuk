<?php

namespace App\Http\Controllers\Dashboard\KiosResmi;

use App\Http\Controllers\Controller;
use App\Http\Requests\KiosResmiGantiNoTelpRequest;
use App\Http\Requests\KiosResmiLoginRequest;
use App\Services\AkunService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AkunController extends Controller
{
    private AkunService $akun_service;
    public function __construct(AkunService $akun_service) {
        $this->akun_service = $akun_service;
    }
    public function setGantiSandi()
    {
        return response()->view('dashboard.kios-resmi.pages.ganti-sandi', [
            'title' => 'Kios Resmi | Ganti Kata Sandi'
        ]);
    }
    public function gantiSandi(KiosResmiLoginRequest $request): RedirectResponse
    {
        $id = Session::get('id_kios_resmi',null);
        $validated = $request->validated();
        if($this->akun_service->kiosResmiCekSandi($id,$validated['sandi_lama'])) {
            if($validated['sandi_baru'] == $validated['sandi_ulang']) {
                if($this->akun_service->kiosResmiGantiSandi($id,$validated['sandi_baru']))
                return redirect('/kios-resmi/dashboard')->with('success','Kata sandi berhasil diperbarui');
            }
            return back()->withErrors(['failed' => 'Konfirmasi kata sandi tidak sama']);
        }
        return back()->withErrors(['failed' => 'Kata sandi lama salah']);
    }
    public function gantiNoTelp(KiosResmiGantiNoTelpRequest $request): RedirectResponse
    {
        $id = Session::get('id_kios_resmi',null);
        $validated = $request->validated();
        if($this->akun_service->kiosResmiGantiNoTelp($id, $validated['nomor_telepon']))
        return back()->with('success','Nomor telepon berhasil diperbarui');
        return back()->withErrors(['failed' => 'Nomor telepon gagal diperbarui']);
    }
}
