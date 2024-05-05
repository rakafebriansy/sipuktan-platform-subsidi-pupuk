<?php

namespace App\Http\Controllers\Homepage\Petani;

use App\Http\Controllers\Controller;
use App\Http\Requests\PetaniLoginRequest;
use App\Http\Requests\PetaniRegisterRequest;
use App\Models\KelompokTani;
use App\Services\AkunService;
use Illuminate\Http\RedirectResponse;
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
                $request->session()->regenerate();
                $request->session()->put('id_petani',$petani->id);
                $request->session()->put('role','petani');
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
        $validated = $request->validated();
        $this->akun_service->petaniRegister($validated, $request->file('foto_ktp'));
        return back()->with('success','Silahkan tunggu verifikasi dari akun anda!');
    }
    public function setLupaSandi(): View
    {
        return view('homepage.pages.petani.lupa-sandi',[
            'title' => 'Petani | Lupa Sandi'
        ]);
    }
}
