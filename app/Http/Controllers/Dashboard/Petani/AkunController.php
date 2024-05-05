<?php

namespace App\Http\Controllers\Dashboard\Petani;

use App\Http\Controllers\Controller;
use App\Http\Requests\PetaniGantiSandiRequest;
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
        return response()->view('dashboard.petani.pages.ganti-sandi', [
            'title' => 'Petani | Ganti Kata Sandi'
        ]);
    }
    public function gantiSandi(PetaniGantiSandiRequest $request): RedirectResponse
    {
        $id = Session::get('id_petani',null);
        $validated = $request->validated();
        if($validated['sandi_baru'] == $validated['sandi_ulang']) {
            if($this->akun_service->petaniGantiSandi($id,$validated)) {
                return redirect('/petani/dashboard')->with('success','Kata sandi berhasil diperbarui');
            } else {
                return back()->withErrors(['failed' => 'Kata sandi lama salah']);
            }
        } else {
            return back()->withErrors(['failed' => 'Konfirmasi kata sandi tidak sama']);
        }
    }
}
