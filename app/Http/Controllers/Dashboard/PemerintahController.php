<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PemerintahBuatAlokasiRequest;
use App\Http\Requests\PemerintahEditAlokasiRequest;
use App\Http\Requests\PetaniRegisterRequest;
use App\Models\Alokasi;
use App\Models\Kecamatan;
use App\Models\KiosResmi;
use App\Models\Pemerintah;
use App\Models\Petani;
use App\Services\AkunService;
use App\Services\AlokasiService;
use App\Services\DashboardService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class PemerintahController extends Controller
{
    private AkunService $akun_service;
    private DashboardService $dashboard_service;
    private AlokasiService $alokasi_service;
    public function __construct(AkunService $akun_service, DashboardService $dashboard_service, AlokasiService $alokasi_service)
    {
        $this->alokasi_service = $alokasi_service;
        $this->dashboard_service = $dashboard_service;
        $this->akun_service = $akun_service;
    }
    public function setDashboard(): View
    {
        $id = Session::get('id',null);
        ['pemerintah' => $pemerintah,'initials' =>$initials] = $this->dashboard_service->pemerintahSetSidebar($id); 
        return view('dashboard.pemerintah.pages.index', [
            'title' => 'Pemerintah | Dashboard',
            'pemerintah' => $pemerintah,
            'initials' => $initials
        ]);
    }
    public function setAlokasi(Request $request): View
    {
        $id = Session::get('id',null);
        $tahun = null;
        $mt = null;
        ['pemerintah' => $pemerintah,'initials' =>$initials] = $this->dashboard_service->pemerintahSetSidebar($id); 
        ['tahuns' => $tahuns, 'jenis_pupuks' => $jenis_pupuks] = $this->alokasi_service->pemerintahSetAlokasi();
        if(isset($request->tahun) && isset($request->musim_tanam)){
            $tahun = $request->tahun;
            $mt = $request->musim_tanam;
            $alokasis = $this->alokasi_service->pemerintahSetAlokasiByTahun($tahun,$request->musim_tanam);
        } else {
            $alokasis = $this->alokasi_service->pemerintahSetAlokasiByTahun($tahuns[0]->tahun,'MT1');
        }
        return view('dashboard.pemerintah.pages.alokasi', [
            'title' => 'Pemerintah | Alokasi',
            'pemerintah' => $pemerintah,
            'jenis_pupuks' => $jenis_pupuks,
            'initials' => $initials,
            'tahuns' => $tahuns,
            'alokasis' => $alokasis,
            'tahun' => $tahun,
            'mt' => $mt
        ]);
    }
    public function tambahAlokasi(PemerintahBuatAlokasiRequest $request)
    {
        $validated = $request->validated();
        if($this->alokasi_service->pemerintahTambahAlokasi($validated)) {
            return redirect('/pemerintah/alokasi?tahun=' . $validated['tahun'] . '&musim_tanam=' . $validated['musim_tanam'])->with('success', 'Data alokasi berhasil ditambahkan');
        }
        return redirect('/pemerintah/alokasi?tahun=' . $validated['tahun'] . '&musim_tanam=' . $validated['musim_tanam'])->with(['error' => 'Data alokasi berhasil ditambahkan']);
        
    }
    public function hapusAlokasi(Request $request): RedirectResponse
    {
        if($this->alokasi_service->pemerintahHapusAlokasi($request->id)) {
            return redirect('/pemerintah/alokasi?tahun=' . $request->tahun . '&musim_tanam=' . $request->musim_tanam)->with('success','Data alokasi berhasil dihapus');
        }
        return redirect('/pemerintah/alokasi?tahun=' . $request->tahun . '&musim_tanam=' . $request->musim_tanam)->withErrors(['error' =>'Data alokasi gagal dihapus']);
    }
    public function editAlokasi(PemerintahEditAlokasiRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        if($this->alokasi_service->pemerintahEditAlokasi($validated)) {
            return redirect('/pemerintah/alokasi?tahun=' . $validated['tahun'] . '&musim_tanam=' . $validated['musim_tanam'])->with('success','Data alokasi berhasil diperbarui');
        }
        return redirect('/pemerintah/alokasi?tahun=' . $validated['tahun'] . '&musim_tanam=' . $validated['musim_tanam'])->withErrors(['error','Data alokasi berhasil dihapus']);
    }
    public function setVerifikasiPengguna(): View
    {
        $id = Session::get('id');
        ['pemerintah' => $pemerintah,'initials' =>$initials] = $this->dashboard_service->pemerintahSetSidebar($id); 
        ['petanis' => $petanis, 'kios_resmis' => $kios_resmis] = $this->akun_service->pemerintahSetVerifikasiPengguna();
        return view('dashboard.pemerintah.pages.verifikasi-pengguna', [
            'title' => 'Pemerintah | Verifikasi Pengguna',
            'petanis' => $petanis,
            'kios_resmis' => $kios_resmis,
            'pemerintah' => $pemerintah,
            'initials' => $initials,
        ]);
    }
    public function verifikasiPenggunaPetani(Request $request): RedirectResponse
    {
        $ids = $request->id_petanis;
        if(isset($ids)){
            if($this->akun_service->pemerintahVerifikasiPetani($ids)) {
                return redirect('/pemerintah/verifikasi-pengguna')->with('success','Berhasil memverifikasi akun petani.');
            }
        }
        return redirect('/pemerintah/verifikasi-pengguna')->withErrors(['error' => 'Gagal memverifikasi akun.']);
        
    }
    public function verifikasiPenggunaKiosResmi(Request $request): RedirectResponse
    {
        $ids = $request->id_kios_resmis;
        if(isset($ids)){
            if($this->akun_service->pemerintahVerifikasiKiosResmi($ids)) {
                return redirect('/pemerintah/verifikasi-pengguna')->with('success','Berhasil memverifikasi akun kios resmi.');
            }
        }
        return redirect('/pemerintah/verifikasi-pengguna')->withErrors(['error' => 'Gagal memverifikasi akun.']);
    }
}