<?php

namespace App\Http\Controllers\Dashboard\Pemerintah;

use App\Http\Controllers\Controller;
use App\Http\Requests\PemerintahBuatAlokasiRequest;
use App\Http\Requests\PemerintahEditAlokasiRequest;
use App\Services\AlokasiService;
use App\Services\DashboardService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AlokasiController extends Controller
{
    private DashboardService $dashboard_service;
    private AlokasiService $alokasi_service;

    public function __construct(DashboardService $dashboard_service, AlokasiService $alokasi_service) {
        $this->dashboard_service = $dashboard_service;
        $this->alokasi_service = $alokasi_service;
    }
    public function setAlokasi(Request $request): View
    {
        $id = Auth::guard('pemerintah')->user()->id;
        $tahun = date('Y');
        $musim_tanam = null;
        ['pemerintah' => $pemerintah,
        'initials' =>$initials] = $this->dashboard_service->pemerintahSetSidebar($id); 
        ['saat_ini' => $saat_ini,
        'tahuns' => $tahuns, 
        'jenis_pupuks' => $jenis_pupuks] = $this->alokasi_service->pemerintahSetAlokasi();
        if(isset($request->tahun) && isset($request->musim_tanam)){
            $tahun = $request->tahun;
            $musim_tanam = $request->musim_tanam;
            $alokasis = $this->alokasi_service->pemerintahSetAlokasiByTahun($tahun,$request->musim_tanam);
        } else {
            $musim_tanam = $saat_ini->musim_tanam;
            $alokasis = $this->alokasi_service->pemerintahSetAlokasiByTahun($saat_ini->tahun,$saat_ini->musim_tanam);
        }
        return view('dashboard.pemerintah.pages.alokasi', [
            'title' => 'Pemerintah | Alokasi',
            'pemerintah' => $pemerintah,
            'jenis_pupuks' => $jenis_pupuks,
            'initials' => $initials,
            'tahuns' => $tahuns,
            'alokasis' => $alokasis,
            'tahun' => $tahun,
            'musim_tanam' => $musim_tanam
        ]);
    }
    public function buatAlokasi(PemerintahBuatAlokasiRequest $request):RedirectResponse
    {
        $validated = $request->validated();
        $petani = $this->alokasi_service->pemerintahCekPetani($validated['nik']);
        if(isset($petani)) {
            if($this->alokasi_service->pemerintahBuatAlokasi($validated,$petani)) {
                return back()->with('success', 'Data alokasi berhasil ditambahkan');
            }
            return back()->withErrors(['error' => 'Data alokasi gagal ditambahkan']);
        }
        return back()->withInput()->withErrors(['error' => 'Petani tidak terdaftar']);
    }
    public function hapusAlokasi(Request $request): RedirectResponse
    {
        if($this->alokasi_service->pemerintahHapusAlokasi($request->id)) {
            return back()->with('success','Data alokasi berhasil dihapus');
        }
        return back()->withErrors(['error' =>'Data alokasi gagal dihapus']);
    }
    public function editAlokasi(PemerintahEditAlokasiRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        if($this->alokasi_service->pemerintahEditAlokasi($validated)) {
            return back()->with('success','Data alokasi berhasil diperbarui');
        }
        return back()->withErrors(['error' => 'Data alokasi gagal diperbarui']);
    }
}
