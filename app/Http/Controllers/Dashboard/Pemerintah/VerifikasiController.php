<?php

namespace App\Http\Controllers\Dashboard\Pemerintah;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use App\Services\VerifikasiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class VerifikasiController extends Controller
{
    private DashboardService $dashboard_service;
    private VerifikasiService $verifikasi_service;

    public function __construct(DashboardService $dashboard_service, VerifikasiService $verifikasi_service) {
        $this->dashboard_service = $dashboard_service;
        $this->verifikasi_service = $verifikasi_service;
    }
    public function setVerifikasi(): View
    {
        $id = Session::get('id_pemerintah');
        ['pemerintah' => $pemerintah,'initials' =>$initials] = $this->dashboard_service->pemerintahSetSidebar($id); 
        ['petanis' => $petanis, 'kios_resmis' => $kios_resmis] = $this->verifikasi_service->pemerintahSetVerifikasiPengguna();
        return view('dashboard.pemerintah.pages.verifikasi-pengguna', [
            'title' => 'Pemerintah | Verifikasi Pengguna',
            'petanis' => $petanis,
            'kios_resmis' => $kios_resmis,
            'pemerintah' => $pemerintah,
            'initials' => $initials,
        ]);
    }
    public function verifikasiPetani(Request $request): RedirectResponse
    {
        $ids = $request->id_petanis;
        if(isset($ids)){
            if($this->verifikasi_service->pemerintahVerifikasiPetani($ids)) {
                return redirect('/pemerintah/verifikasi-pengguna')->with('success','Berhasil memverifikasi akun petani.');
            }
        }
        return redirect('/pemerintah/verifikasi-pengguna')->withErrors(['error' => 'Gagal memverifikasi akun.']);
        
    }
    public function verifikasiKiosResmi(Request $request): RedirectResponse
    {
        $ids = $request->id_kios_resmis;
        if(isset($ids)){
            if($this->verifikasi_service->pemerintahVerifikasiKiosResmi($ids)) {
                return redirect('/pemerintah/verifikasi-pengguna')->with('success','Berhasil memverifikasi akun kios resmi.');
            }
        }
        return redirect('/pemerintah/verifikasi-pengguna')->withErrors(['error' => 'Gagal memverifikasi akun.']);
    }
}
