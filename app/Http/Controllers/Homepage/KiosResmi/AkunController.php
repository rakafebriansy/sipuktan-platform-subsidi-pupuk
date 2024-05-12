<?php

namespace App\Http\Controllers\Homepage\KiosResmi;

use App\Http\Controllers\Controller;
use App\Http\Requests\KiosResmiLoginRequest;
use App\Http\Requests\KiosResmiLupaSandiRequest;
use App\Http\Requests\KiosResmiLupaUbahSandiRequest;
use App\Http\Requests\KiosResmiRegisterRequest;
use App\Models\Kecamatan;
use App\Services\AkunService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AkunController extends Controller
{
    private AkunService $akun_service;
    public function __construct(AkunService $akun_service)
    {
        $this->akun_service = $akun_service;
    }
    public function setRegister(): View
    {
        $kecamatans = Kecamatan::all();
        return view('homepage.pages.kios-resmi.register',[
            'title' => 'Kios Resmi | Register',
            'kecamatans' => $kecamatans
        ]);
    }
    public function register(KiosResmiRegisterRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $this->akun_service->kiosResmiRegister($validated, $request->file('foto_ktp'));
            return back()->with('success','Silakan tunggu verifikasi untuk akun anda!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors('dbErr','Akun gagal dibuat!');
        }
    }
    public function setLogin(): View
    {
        return view('homepage.pages.kios-resmi.login',[
            'title' => 'Kios Resmi | Login'
        ]);
    }

    public function login(KiosResmiLoginRequest $request): RedirectResponse
    {
        $kios_resmi = $this->akun_service->kiosResmiLogin($request->nib,$request->kata_sandi);
        if(isset($kios_resmi)) {
            if($kios_resmi->aktif) {
                $request->session()->regenerate();
                $request->session()->put('id_kios_resmi',$kios_resmi->id);
                $request->session()->put('role','kios-resmi');
                return redirect('/kios-resmi/dashboard');

            }
            return back()->with('unverified','Akun anda belum diverifikasi');
        } 
        return back()->withErrors(['failed' => 'Kredensial salah']);
    }
    
    public function setLupaSandi(): View
    {
        return view('homepage.pages.kios-resmi.lupa-sandi',[
            'title' => 'Kios Resmi | Lupa Sandi'
        ]);
    }
    public function lupaSandi(KiosResmiLupaSandiRequest $request): RedirectResponse
    {
        $validated  = $request->validated();
        $kios_resmi = $this->akun_service->kiosResmiLupaSandi($validated['nomor_telepon']);
        if(isset($kios_resmi)) {
            return redirect('/kios-resmi/lupa-ubah-sandi')->with('id_kios_resmi',$kios_resmi->id);
        }
        return back()->withErrors(['error' => 'Nomor telepon tidak terdaftar!']);
    }
    public function setUbahSandi(): View
    {
        return view('homepage.pages.kios-resmi.lupa-ubah-sandi',[
            'title' => 'Kios Resmi | Buat Sandi Baru'
        ]);
    }
    public function ubahSandi(KiosResmiLupaUbahSandiRequest $request): RedirectResponse
    {
        $validated  = $request->validated();
        if($validated['sandi_baru'] == $validated['sandi_ulang']) {
            if($this->akun_service->kiosResmiLupaUbahSandi($validated['id_kios_resmi'],$validated['sandi_baru'])) {
                return redirect('/kios-resmi/login')->with('success','Kata sandi berhasil diperbarui');
            }
            return back()->withErrors(['failed' => 'Token tidak valid']);
        }
        return back()->withErrors(['failed' => 'Konfirmasi kata sandi tidak sama']);
    }
}
