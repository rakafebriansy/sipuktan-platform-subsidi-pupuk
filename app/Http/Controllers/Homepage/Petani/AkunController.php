<?php

namespace App\Http\Controllers\Homepage\Petani;

use App\Http\Controllers\Controller;
use App\Http\Requests\PetaniLoginRequest;
use App\Http\Requests\PetaniLupaSandiRequest;
use App\Http\Requests\PetaniLupaUbahSandi;
use App\Http\Requests\PetaniLupaUbahSandiRequest;
use App\Http\Requests\PetaniRegisterRequest;
use App\Models\KelompokTani;
use App\Services\AkunService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;

class AkunController extends Controller
{
    private AkunService $akun_service;

    public function __construct(AkunService $akun_service)
    {
        $this->akun_service = $akun_service;
    }
    public function setLogin(): View
    {
        return view('homepage.pages.petani.login',[
            'title' => 'Petani | Login'
        ]);
    }
    public function login(PetaniLoginRequest $request): RedirectResponse
    {
        $petani = $this->akun_service->petaniLogin($request->nik,$request->kata_sandi);
        if(isset($petani)) {
            if($petani->aktif) {
                if($request->remember == 'on'){
                    setcookie('sipuktan_nik',$request->nik,time() + 60*24);
                    setcookie('sipuktan_kata_sandi_petani',$request->kata_sandi,time() + 60*24);
                }
                return redirect('/petani/dashboard');
            }
            return back()->with('unverified','Akun anda belum diverifikasi');
        } 
        return back()->withErrors(['failed' => 'Kredensial salah']);
    }
    public function setRegister(): View
    {
        $kelompok_tanis = KelompokTani::all();
        return view('homepage.pages.petani.register',[
            'title' => 'Petani | Register',
            'kelompok_tanis' => $kelompok_tanis
        ]);
    }
    public function register(PetaniRegisterRequest $request): RedirectResponse
    {
        try {
            $validated = $request->validated();
            $this->akun_service->petaniRegister($validated, $request->file('foto_ktp'));
            return back()->with('success','Silakan tunggu verifikasi untuk akun anda!');
        } catch (\Exception $e) {
            return back()->withInput()->withErrors('dbErr','Akun gagal dibuat!');
        }
    }
    public function setLupaSandi(): View
    {
        return view('homepage.pages.petani.lupa-sandi',[
            'title' => 'Petani | Lupa Sandi'
        ]);
    }
    public function lupaSandi(PetaniLupaSandiRequest $request): RedirectResponse
    {
        $validated  = $request->validated();
        $petani = $this->akun_service->petaniLupaSandi($validated['nomor_telepon']);
        if(isset($petani)) {
            return redirect('/petani/lupa-ubah-sandi')->with('id_petani',$petani->id);
        }
        return back()->withErrors(['error' => 'Nomor telepon tidak terdaftar!']);
    }
    public function setUbahSandi(): View
    {
        return view('homepage.pages.petani.lupa-ubah-sandi',[
            'title' => 'Petani | Buat Sandi Baru'
        ]);
    }
    public function ubahSandi(PetaniLupaUbahSandiRequest $request): RedirectResponse
    {
        $validated  = $request->validated();
        if($validated['sandi_baru'] == $validated['sandi_ulang']) {
            if($this->akun_service->petaniLupaUbahSandi($validated['id_petani'],$validated['sandi_baru'])){
                return redirect('/petani/login')->with('success','Kata sandi berhasil diperbarui');
            }
            return back()->withErrors(['failed' => 'Token tidak valid']);
        }
        return back()->withErrors(['failed' => 'Konfirmasi kata sandi tidak sama']);
    }
}
