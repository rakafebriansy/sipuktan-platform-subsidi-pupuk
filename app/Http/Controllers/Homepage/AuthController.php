<?php
namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Http\Requests\KiosResmiGantiSandiRequest;
use App\Http\Requests\KiosResmiLoginRequest;
use App\Http\Requests\KiosResmiRegisterRequest;
use App\Http\Requests\pemerintahGantiSandiRequest;
use App\Http\Requests\PemerintahLoginRequest;
use App\Http\Requests\PetaniGantiSandiRequest;
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
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
class AuthController extends Controller
{
    private AkunService $akun_service;
    public function username()
    {
        return 'nik';
    }   

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
        $petani = $this->akun_service->petaniLogin($request->nik,$request->kata_sandi);
        if(isset($petani)) {
            if($petani->aktif) {
                $request->session()->regenerate();
                $request->session()->put('id',$petani->id);
                $request->session()->put('role','petani');
                return response()->redirectTo('/petani/dashboard');
            }
            return redirect()->intended('/petani/login')->with('unverified','Akun anda belum diverifikasi');
        } 
        return redirect()->intended('/petani/login')->withErrors(['failed' => 'Kredensial salah']);
    }
    public function kiosResmiLogin(KiosResmiLoginRequest $request): RedirectResponse
    {
        $kios_resmi = $this->akun_service->kiosResmiLogin($request->nib,$request->kata_sandi);
        if(isset($kios_resmi)) {
            if($kios_resmi->aktif) {
                $request->session()->regenerate();
                $request->session()->put('id',$kios_resmi->id);
                $request->session()->put('role','kios-resmi');
                return response()->redirectTo('/kios-resmi/dashboard');

            }
            return redirect('/kios-resmi/login')->with('unverified','Akun anda belum diverifikasi');
        } 
        return response()->redirectTo('/kios-resmi/login')->withErrors(['failed' => 'Kredensial salah']);
    }
    public function pemerintahLogin(PemerintahLoginRequest $request): RedirectResponse
    {
        $pemerintah = $this->akun_service->pemerintahLogin($request->nama_pengguna,$request->kata_sandi);
        if(isset($pemerintah)) {
            $request->session()->regenerate();
            $request->session()->put('id',$pemerintah->id);
            $request->session()->put('role','pemerintah');
            return response()->redirectTo('/pemerintah/dashboard');
        } 
        return response()->redirectTo('/pemerintah/login')->withErrors(['failed' => 'Kredensial salah']);
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
            return redirect()->intended('/petani/register')->with('success','Silahkan tunggu verifikasi dari akun anda!');
        } catch (\Exception $e) {
            return redirect()->intended('/petani/register')->withErrors('dbErr','Akun gagal dibuat!');
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
            return redirect()->intended('/kios-resmi/register')->with('success','Silahkan tunggu verifikasi dari akun anda!');
        } catch (\Exception $e) {
            return redirect()->intended('/kios-resmi/register')->withErrors('dbErr','Akun gagal dibuat!');
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
    public function setPetaniGantiSandi()
    {
        $id = Session::get('id',null);
        if(isset($id)){
            return response()->view('dashboard.petani.pages.ganti-sandi', [
                'title' => 'Petani | Ganti Kata Sandi'
            ]);
        } else {
            return abort(403);
        }
    }
    public function setPemerintahGantiSandi()
    {
        $id = Session::get('id',null);
        if(isset($id)){
            return response()->view('dashboard.pemerintah.pages.ganti-sandi', [
                'title' => 'Pemerintah | Ganti Kata Sandi'
            ]);
        } else {
            return abort(403);
        }
    }
    public function setKiosResmiGantiSandi()
    {
        $id = Session::get('id',null);
        if(isset($id)){
            return response()->view('dashboard.kios-resmi.pages.ganti-sandi', [
                'title' => 'Kios Resmi | Ganti Kata Sandi'
            ]);
        } else {
            return abort(403);
        }
    }
    public function petaniGantiSandi(PetaniGantiSandiRequest $request): RedirectResponse
    {
        $id = Session::get('id',null);
        if(isset($id)){
            try {
                $validated = $request->validated();
                if($validated['sandi_baru'] == $validated['sandi_ulang']) {
                    if($this->akun_service->petaniGantiSandi($id,$validated)) {
                        return redirect('/petani/dashboard')->with('success','Kata sandi berhasil diperbarui');
                    } else {
                        return redirect('/petani/ganti-sandi')->withErrors(['failed' => 'Kata sandi lama salah']);
                    }
                } else {
                    return redirect('/petani/ganti-sandi')->withErrors(['failed' => 'Konfirmasi kata sandi tidak sama']);
                }
            } catch (\Exception $e) {
                throw $e;

            }
        } else {
            return abort(403);
        }
    }
    public function kiosResmiGantiSandi(KiosResmiGantiSandiRequest $request): RedirectResponse
    {
        $id = Session::get('id',null);
        if(isset($id)){
            try {
                $validated = $request->validated();
                if($validated['sandi_baru'] == $validated['sandi_ulang']) {
                    if($this->akun_service->kiosResmiGantiSandi($id,$validated)) {
                        return redirect('/kios-resmi/dashboard')->with('success','Kata sandi berhasil diperbarui');
                    } else {
                        return redirect('/kios-resmi/ganti-sandi')->withErrors(['failed' => 'Kata sandi lama salah']);
                    }
                } else {
                    return redirect('/kios-resmi/ganti-sandi')->withErrors(['failed' => 'Konfirmasi kata sandi tidak sama']);
                }
            } catch (\Exception $e) {
                throw $e;
            }
        } else {
            return abort(403);
        }
    }
    public function pemerintahGantiSandi(pemerintahGantiSandiRequest $request): RedirectResponse
    {
        $id = Session::get('id',null);
        if(isset($id)){
            try {
                $validated = $request->validated();
                if($validated['sandi_baru'] == $validated['sandi_ulang']) {
                    if($this->akun_service->pemerintahGantiSandi($id,$validated)) {
                        return redirect('/pemerintah/dashboard')->with('success','Kata sandi berhasil diperbarui');
                    } else {
                        return redirect('/pemerintah/ganti-sandi')->withErrors(['failed' => 'Kata sandi lama salah']);
                    }
                } else {
                    return redirect('/pemerintah/ganti-sandi')->withErrors(['failed' => 'Konfirmasi kata sandi tidak sama']);
                }
            } catch (\Exception $e) {
                throw $e;
            }
        } else {
            return abort(403);
        }
    }
    public function logout(Request $request): RedirectResponse
    {
        $request->session()->invalidate();
        return response()->redirectTo("/");
    }
}