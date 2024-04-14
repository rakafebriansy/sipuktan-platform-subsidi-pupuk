<?php
namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Http\Requests\KiosResmiRegisterRequest;
use App\Http\Requests\PetaniRegisterRequest;
use App\Services\AkunService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    private AkunService $akun_service;

    public function __construct(AkunService $akun_service)
    {
        $this->akun_service = $akun_service;
    }
    public function setPetaniLogin(): Response
    {
        dd('kontol');
        return response()->view('homepage.pages.petani.login',[
            'title' => 'Petani | Login'
        ]);
    }
    public function setKiosResmiLogin(): Response
    {
        return response()->view('homepage.pages.kios-resmi.login',[
            'title' => 'Kios Resmi | Login'
        ]);
    }
    public function setPemerntahLogin(): Response
    {
        return response()->view('homepage.pages.pemerintah.login',[
            'title' => 'Pemerintah | Login'
        ]);
    }
    public function login(Request $request): RedirectResponse
    {
        if(Auth::guard('petani')->attempt([
            'nik' => $request->nik,
            'kata_sandi' => $request->nik
        ])) {
            return response()->redirectTo('/petani/dashboard');
        } else if (Auth::guard('kiosResmi')->attempt([
            'nib' => $request->nib,
            'kata_sandi' => $request->kata_sandi
        ])) {
            return response()->redirectTo('/kios-resmi/dashboard');
        } else if (Auth::guard('pemerintah')->attempt([
            'nama_pengguna' => $request->nama_pengguna,
            'kata_sandi' => $request->kata_sandi
        ])) {
            return response()->redirectTo('/pemerintah/dashboard');
        }
        return response()->redirectTo('/');
    }
    public function setPetaniRegister(): Response
    {
        return response()->view('homepage.pages.petani.register',[
            'title' => 'Petani | Register'
        ]);
    }
    public function petaniRegister(PetaniRegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        
        try {
            $this->akun_service->petaniRegister($validated);
            return redirect('/petani/login')->with('success','Akun berhasil terdaftar!');
        } catch (\Exception $e) {
            return redirect('/petani/register')->withErrors('dbErr','Akun gagal dibuat!');
        }
    }
    public function setKiosResmiRegister(): Response
    {
        return response()->view('homepage.pages.kios-resmi.register',[
            'title' => 'Kios Resmi | Register'
        ]);
    }
    public function kiosResmiRegister(KiosResmiRegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        
        try {
            $this->akun_service->kiosResmiRegister($validated);
            return redirect('/petani/login')->with('success','Akun berhasil terdaftar!');
        } catch (\Exception $e) {
            return redirect('/petani/register')->withErrors('dbErr','Akun gagal dibuat!');
        }
    }
    public function setPetaniLupaSandi(): Response
    {
        return response()->view('homepage.pages.petani.lupa-sandi',[
            'title' => 'Petani | Lupa Sandi'
        ]);
    }
    public function setKiosResmiLupaSandi(): Response
    {
        return response()->view('homepage.pages.kios-resmi.lupa-sandi',[
            'title' => 'Kios Resmi | Lupa Sandi'
        ]);
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        return $this->loggedOut($request) ?: redirect('/petani/login');
    }
}