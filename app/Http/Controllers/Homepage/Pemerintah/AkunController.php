<?php

namespace App\Http\Controllers\Homepage\Pemerintah;

use App\Http\Controllers\Controller;
use App\Http\Requests\PemerintahLoginRequest;
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
        return view('homepage.pages.pemerintah.login',[
            'title' => 'Pemerintah | Login'
        ]);
    }
    public function login(PemerintahLoginRequest $request): RedirectResponse
    {
        $pemerintah = $this->akun_service->pemerintahLogin($request->nama_pengguna,$request->kata_sandi);
        if(isset($pemerintah)) {
            return redirect('/pemerintah/dashboard');
        } 
        return back()->withErrors(['failed' => 'Kredensial salah']);
    }

}
