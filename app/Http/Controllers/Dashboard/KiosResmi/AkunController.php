<?php

namespace App\Http\Controllers\Dashboard\KiosResmi;

use App\Http\Controllers\Controller;
use App\Http\Requests\KiosResmiLoginRequest;
use App\Services\AkunService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class AkunController extends Controller
{
    private AkunService $akun_service;
    public function __construct(AkunService $akun_service) {
        $this->akun_service = $akun_service;
    }
    public function setGantiSandi()
    {
        $id = Session::get('id',null);
        return response()->view('dashboard.kios-resmi.pages.ganti-sandi', [
            'title' => 'Kios Resmi | Ganti Kata Sandi'
        ]);
    }
    public function kiosResmiGantiSandi(KiosResmiLoginRequest $request): RedirectResponse
    {
        $id = Session::get('id',null);
        $validated = $request->validated();
        if($validated['sandi_baru'] == $validated['sandi_ulang']) {
            if($this->akun_service->kiosResmiGantiSandi($id,$validated)) {
                return redirect('/kios-resmi/dashboard')->with('success','Kata sandi berhasil diperbarui');
            } else {
                return redirect('/kios-resmi/ganti-sandi')->withErrors(['failed' => 'Kata sandi lama salah']);
            }
        } else {
            return redirect('/kios-resmi/ganti-sandi')->withErrors(['failed' => 'Konfirmasi kata sandi tidak sama']);
        }
    }
}
