<?php

namespace App\Http\Controllers\Dashboard\Pemerintah;

use App\Http\Controllers\Controller;
use App\Http\Requests\PemerintahUbahSandiRequest;
use App\Services\AkunService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AkunController extends Controller
{
    private AkunService $akun_service;
    public function __construct(AkunService $akun_service) {
        $this->akun_service = $akun_service;
    }
    public function setUbahSandi()
    {
        return response()->view('dashboard.pemerintah.pages.ubah-sandi', [
            'title' => 'Pemerintah | Ubah Kata Sandi'
        ]);
    }
    public function ubahSandi(PemerintahUbahSandiRequest $request): RedirectResponse
    {
        $id = Auth::guard('pemerintah')->user()->id;
        $validated = $request->validated();
        if($this->akun_service->pemerintahCekSandi($id,$validated['sandi_lama'])) {
            if($validated['sandi_baru'] == $validated['sandi_ulang']) {
                $this->akun_service->pemerintahUbahSandi($id,$validated['sandi_baru']);
                return redirect('/pemerintah/dashboard')->with('success','Kata sandi berhasil diperbarui');
            }
            return back()->withErrors(['failed' => 'Konfirmasi kata sandi tidak sama']);
        }
        return back()->withErrors(['failed' => 'Kata sandi lama salah']);
    }
    public function logout()
    {
        Auth::guard('pemerintah')->logout();
        return redirect("/");
    }
}
