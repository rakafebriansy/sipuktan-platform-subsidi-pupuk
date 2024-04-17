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
    private DashboardService $dashboard_service;
    private AlokasiService $alokasi_service;
    public function __construct(DashboardService $dashboard_service, AlokasiService $alokasi_service)
    {
        $this->alokasi_service = $alokasi_service;
        $this->dashboard_service = $dashboard_service;
    }
    public function setDashboard(): View
    {
        $id = Session::get('id',null);
        if(isset($id)) {
            $pemerintah = Pemerintah::find($id); 
            return view('dashboard.pemerintah.pages.index', [
                'title' => 'Pemerintah | Dashboard',
                'pemerintah' => $pemerintah
            ]);
        } else {
            return abort(403);
        }
    }
    public function setAlokasi(Request $request): View
    {
        $id = Session::get('id',null);
        $tahun = null;
        $mt = null;
        if(isset($id)){
            ['kios_resmi' => $pemerintah,'initials' =>$initials] = $this->dashboard_service->pemerintahSetSidebar($id); 
            ['tahuns' => $tahuns, 'jenis_pupuks' => $jenis_pupuks] = $this->alokasi_service->pemerintahSetAlokasi();
            if(isset($request->tahun) && isset($request->musim_tanam)){
                $tahun = $request->tahun;
                $mt = $request->musim_tanam;
                $alokasis = $this->alokasi_service->pemerintahGetAlokasiByTahun($tahun,$request->musim_tanam);
            } else {
                $alokasis = $this->alokasi_service->pemerintahGetAlokasiByTahun($tahuns[0]->tahun,'MT1');
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
        } else {
            return abort(403);
        }
    }
    public function tambahAlokasi(PemerintahBuatAlokasiRequest $request)
    {
        $id = Session::get('id',null);
        if(isset($id)){
            try {

                $validated = $request->validated();
                $this->alokasi_service->pemerintahTambahAlokasi($validated);
                return redirect('/pemerintah/alokasi?tahun=' . $validated['tahun'] . '&musim_tanam=' . $validated['musim_tanam'])->with('success', 'Data alokasi berhasil ditambahkan');
            } catch (\Exception $e) {
                throw $e;
            }
        } else {
            return abort(403);
        }
    }
    public function hapusAlokasi(Request $request): RedirectResponse
    {
        $id = Session::get('id',null);
        if(isset($id)){
            try {
                $this->alokasi_service->pemerintahHapusAlokasi($request->id);
                return redirect('/pemerintah/alokasi?tahun=' . $request->tahun . '&musim_tanam=' . $request->musim_tanam)->with('success','Data alokasi berhasil dihapus');
            } catch (\Exception $e) {
                throw $e;
            }
        } else {
            return abort(403);
        }
    }
    public function editAlokasi(PemerintahEditAlokasiRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        try {
            $this->alokasi_service->pemerintahEditAlokasi($validated);
            return redirect('/pemerintah/alokasi?tahun=' . $validated['tahun'] . '&musim_tanam=' . $validated['musim_tanam'])->with('success','Data alokasi berhasil diperbarui');
        } catch (\Exception $e) {
            throw $e;
        }
    }
    public function setVerifikasiPengguna(): View
    {
        $id = Session::get('id',null);
        if(isset($id)) {
            $pemerintah = Pemerintah::find($id); 
            try {
                $petanis = Petani::select('petanis.*','kelompok_tanis.nama as nama_poktan')
                    ->join('kelompok_tanis','petanis.id_kelompok_tani','kelompok_tanis.id','kelompok_tanis.id')
                    ->where('aktif',false)->get();
                $kios_resmis = KiosResmi::select('kios_resmis.*','pemilik_kios.*','kecamatans.nama as kecamatan')
                    ->join('pemilik_kios','kios_resmis.id_pemilik_kios','pemilik_kios.id')
                    ->join('kecamatans','kios_resmis.id_kecamatan','kecamatans.id')
                    ->where('aktif',false)->get();
                return view('dashboard.pemerintah.pages.verifikasi-pengguna', [
                    'title' => 'Pemerintah | Verifikasi Pengguna',
                    'petanis' => $petanis,
                    'kios_resmis' => $kios_resmis,
                    'pemerintah' => $pemerintah,
                ]);
            } catch (\Exception $e) {
                throw $e;
            }
        } else {
            return abort(403);
        }
    }
    public function verifikasiPenggunaPetani(Request $request): RedirectResponse
    {
        $id = Session::get('id',null);
        if(isset($id)){
            try {
                $ids = $request->id_petanis;
                $rows_affected = Petani::whereIn('id',$ids)->update(['aktif' => true]);
                if($rows_affected) {
                    return redirect('/pemerintah/verifikasi-pengguna')->with('success','Berhasil memverifikasi akun petani.');
                } else {
                    return redirect('/pemerintah/verifikasi-pengguna')->with('error','Gagal memverifikasi akun.');
                }
            } catch (\Exception $e) {
                throw $e;
            }
        } else {
            return abort(403);
        }
    }
    public function verifikasiPenggunaKiosResmi(Request $request): RedirectResponse
    {
        $id = Session::get('id',null);
        if(isset($id)){
            try {
                $ids = $request->id_kios_resmis;
                $rows_affected = KiosResmi::whereIn('id',$ids)->update(['aktif' => true]);
                if($rows_affected) {
                    return redirect('/pemerintah/verifikasi-pengguna')->with('success','Berhasil memverifikasi akun petani.');
                } else {
                    return redirect('/pemerintah/verifikasi-pengguna')->with('error','Gagal memverifikasi akun.');
                }
            } catch (\Exception $e) {
                throw $e;
            }
        } else {
            return abort(403);
        }
    }
}
