<?php

namespace App\Http\Controllers\Homepage\KiosResmi;

use App\Http\Controllers\Controller;
use App\Http\Requests\KiosResmiLoginRequest;
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
                $request->session()->put('id',$kios_resmi->id);
                $request->session()->put('role','kios-resmi');
                return redirect('/kios-resmi/dashboard');

            }
            return redirect('/kios-resmi/login')->with('unverified','Akun anda belum diverifikasi');
        } 
        return redirect('/kios-resmi/login')->withErrors(['failed' => 'Kredensial salah']);
    }
    
    public function setLupaSandi(): View
    {
        return view('homepage.pages.kios-resmi.lupa-sandi',[
            'title' => 'Kios Resmi | Lupa Sandi'
        ]);
    }
}
