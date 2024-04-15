<?php
namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Http\Requests\KiosResmiLoginRequest;
use App\Http\Requests\KiosResmiRegisterRequest;
use App\Http\Requests\PemerintahLoginRequest;
use App\Http\Requests\PetaniLoginRequest;
use App\Http\Requests\PetaniRegisterRequest;
use App\Models\Kecamatan;
use App\Models\KelompokTani;
use App\Models\KiosResmi;
use App\Models\Pemerintah;
use App\Models\Petani;
use App\Services\AkunService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    private AkunService $akun_service;

    public function __construct(AkunService $akun_service)
    {
        $this->akun_service = $akun_service;
    }
    public function setPetaniLogin(): Response
    {
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
    public function setPemerintahLogin(): Response
    {
        return response()->view('homepage.pages.pemerintah.login',[
            'title' => 'Pemerintah | Login'
        ]);
    }
    public function petaniLogin(PetaniLoginRequest $request): RedirectResponse
    {
        // if(Auth::guard('petani')->attempt([
        //     'nik' => $request->input('nik'),
        //     'kata_sandi' => $request->input('kata_sandi')
        // ])) {
        //     return response()->redirectTo('/petani/dashboard');
        // }
        $petani = Petani::query()->where('nik',$request->nik)->first();
        if (isset($petani)) {
            if(Hash::check($request->kata_sandi,$petani->kata_sandi)) {
                if($petani->is_active) {
                    $request->session()->put('id',$petani->id);
                    return response()->redirectTo('/petani/dashboard');
                }
                return redirect('/petani/login')->with('unverified','Akun anda belum diverifikasi');
            }
        }
        return response()->redirectTo('/petani/login');
    }
    public function kiosResmiLogin(KiosResmiLoginRequest $request): RedirectResponse
    {
        $kios_resmi = KiosResmi::query()->where('nib',$request->nib)->first();
        if (isset($kios_resmi))
        {
            if(Hash::check($request->kata_sandi,$kios_resmi->kata_sandi)) {
                if($kios_resmi->is_active) {
                    $request->session()->put('id',$kios_resmi->id);
                    return response()->redirectTo('/kios-resmi/dashboard');
                }
                return redirect('/kios-resmi/login')->with('unverified','Akun anda belum diverifikasi');
            }
        }
        return response()->redirectTo('/kios-resmi/login');
    }
    public function pemerintahLogin(PemerintahLoginRequest $request): RedirectResponse
    {
        $pemerintah = Pemerintah::query()->where('nama_pengguna',$request->nama_pengguna)->first();
        if (isset($pemerintah))
        {
            if(Hash::check($request->kata_sandi,$pemerintah->kata_sandi)) {
                $request->session()->put('id',$pemerintah->id);
                return response()->redirectTo('/pemerintah/dashboard');
            }
        }
        return response()->redirectTo('/admin');
    }
    public function setPetaniRegister(): Response
    {
        $kelompok_tanis = KelompokTani::all();
        return response()->view('homepage.pages.petani.register',[
            'title' => 'Petani | Register',
            'kelompok_tanis' => $kelompok_tanis
        ]);
    }
    public function petaniRegister(PetaniRegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        try {
            $this->akun_service->petaniRegister($validated, $request->file('foto_ktp'));
            return redirect('/petani/register')->with('success','Silahkan tunggu verifikasi dari akun anda!');
        } catch (\Exception $e) {
            return redirect('/petani/register')->withErrors('dbErr','Akun gagal dibuat!');
        }
    }
    public function setKiosResmiRegister(): Response
    {
        $kecamatans = Kecamatan::all();
        return response()->view('homepage.pages.kios-resmi.register',[
            'title' => 'Kios Resmi | Register',
            'kecamatans' => $kecamatans
        ]);
    }
    public function kiosResmiRegister(KiosResmiRegisterRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        try {
            $this->akun_service->kiosResmiRegister($validated, $request->file('foto_ktp'));
            return redirect('/kios-resmi/register')->with('success','Silahkan tunggu verifikasi dari akun anda!');
        } catch (\Exception $e) {
            return redirect('/kios-resmi/register')->withErrors('dbErr','Akun gagal dibuat!');
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