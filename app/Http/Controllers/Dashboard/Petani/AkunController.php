<?php

namespace App\Http\Controllers\Dashboard\Petani;

use App\Http\Controllers\Controller;
use App\Http\Requests\PetaniGantiNoTelpRequest;
use App\Http\Requests\PetaniGantiSandiRequest;
use App\Http\Requests\PetaniUbahNoTelpRequest;
use App\Http\Requests\PetaniUbahSandiRequest;
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

    public function setUbahSandi()
    {
        return response()->view('dashboard.petani.pages.ubah-sandi', [
            'title' => 'Petani | Ubah Kata Sandi'
        ]);
    }
    public function ubahSandi(PetaniUbahSandiRequest $request): RedirectResponse
    {
        $id = Session::get('id_petani',null);
        $validated = $request->validated();
        if($this->akun_service->petaniCekSandi($id,$validated['sandi_lama'])) {
            if($validated['sandi_baru'] == $validated['sandi_ulang']) {
                $this->akun_service->petaniUbahSandi($id,$validated['sandi_baru']);
                return redirect('/petani/dashboard')->with('success','Kata sandi berhasil diperbarui');
            }
            return back()->withErrors(['failed' => 'Konfirmasi kata sandi tidak sama']);
        }
        return back()->withErrors(['failed' => 'Kata sandi lama salah']);
    }
    public function ubahNoTelp(PetaniUbahNoTelpRequest $request): RedirectResponse
    {
        $id = Session::get('id_petani',null);
        $validated = $request->validated();
        if($this->akun_service->petaniUbahNoTelp($id, $validated['nomor_telepon']))
        return back()->with('success','Nomor telepon berhasil diperbarui');
        return back()->withErrors(['failed' => 'Nomor telepon gagal diperbarui']);
    }
}
