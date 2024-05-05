<?php

namespace App\Http\Controllers\Dashboard\Pemerintah;

use App\Http\Controllers\Controller;
use App\Http\Requests\PemerintahGantiSandiRequest;
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
        return response()->view('dashboard.pemerintah.pages.ganti-sandi', [
            'title' => 'Pemerintah | Ganti Kata Sandi'
        ]);
    }
    public function gantiSandi(PemerintahGantiSandiRequest $request): RedirectResponse
    {
        $id = Session::get('id_pemerintah',null);
        $validated = $request->validated();
        if($this->akun_service->pemerintahCekSandi($id,$validated['sandi_lama'])) {
            if($validated['sandi_baru'] == $validated['sandi_ulang']) {
                $this->akun_service->pemerintahGantiSandi($id,$validated['sandi_baru']);
                return redirect('/pemerintah/dashboard')->with('success','Kata sandi berhasil diperbarui');
            }
            return back()->withErrors(['failed' => 'Konfirmasi kata sandi tidak sama']);
        }
        return back()->withErrors(['failed' => 'Kata sandi lama salah']);
    }
}
