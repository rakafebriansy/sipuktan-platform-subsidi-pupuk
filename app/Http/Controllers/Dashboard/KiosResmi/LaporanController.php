<?php

namespace App\Http\Controllers\Dashboard\KiosResmi;

use App\Http\Controllers\Controller;
use App\Http\Requests\KiosResmiLaporanRequest;
use App\Services\DashboardService;
use App\Services\LaporanService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class LaporanController extends Controller
{
    private DashboardService $dashboard_service;
    private LaporanService $laporan_service;
    public function __construct(LaporanService $laporan_service, DashboardService $dashboard_service) {
        $this->laporan_service = $laporan_service;
        $this->dashboard_service = $dashboard_service;
    }
    public function setLaporan(Request $request): View
    {
        $id = Auth::guard('kiosResmi')->user()->id;
        $tahun = date('Y');
        $musim_tanam = null;
        ['kios_resmi' => $kios_resmi,
        'notifikasis' => $notifikasis,
        'initials' =>$initials] = $this->dashboard_service->kiosResmiSetSidebar($id);
        ['saat_ini' => $saat_ini,
        'tahuns' => $tahuns] = $this->laporan_service->kiosResmiSetLaporan($id);
        if(isset($request->tahun) && isset($request->musim_tanam)) {
            $tahun = $request->tahun;
            $musim_tanam = $request->musim_tanam;
            $laporans = $this->laporan_service->kiosResmiSetLaporanByTahun($id, $tahun, $musim_tanam);
        } else {
            $musim_tanam = $saat_ini->musim_tanam;
            $laporans = $this->laporan_service->kiosResmiSetLaporanByTahun($id, $saat_ini->tahun, $saat_ini->musim_tanam);
        }
        return view('dashboard.kios-resmi.pages.laporan', [
            'title' => 'Kios Resmi | Laporan',
            'kios_resmi' => $kios_resmi,
            'initials' => $initials,
            'laporans' => $laporans,
            'notifikasis' => $notifikasis,
            'tahuns' => $tahuns,
            'tahun' => $tahun,
            'musim_tanam' => $musim_tanam
        ]);
    }
    public function laporan(KiosResmiLaporanRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        if($this->laporan_service->kiosResmiLaporan($validated)) {
            return back()->with('success', 'Data laporan berhasil ditambahkan');
        }
        return back()->withInput()->with(['error' => 'Data laporan gagal ditambahkan']);
    }
}
