<?php

namespace App\Http\Controllers\Dashboard\Pemerintah;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use App\Services\LaporanService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class LaporanController extends Controller
{
    private DashboardService $dashboard_service;
    private LaporanService $laporan_service;
    public function __construct(DashboardService $dashboard_service, LaporanService $laporan_service) {
        $this->dashboard_service = $dashboard_service;
        $this->laporan_service = $laporan_service;
    }
    public function setLaporan(Request $request): View
    {
        $id = Session::get('id');
        $tahun = date('Y');
        $musim_tanam = null;
        ['pemerintah' => $pemerintah,'initials' =>$initials] = $this->dashboard_service->pemerintahSetSidebar($id);
        $tahuns = $this->laporan_service->kiosResmiSetLaporan($id);
        if(isset($request->tahun) && isset($request->musim_tanam)){
            $tahun = $request->tahun;
            $musim_tanam = $request->musim_tanam;
            $laporans = $this->laporan_service->pemerintahSetLaporan($tahun, $musim_tanam);
        } else {
            $laporans = $this->laporan_service->pemerintahSetLaporan($tahun, 'MT1');
        }
        return view('dashboard.pemerintah.pages.laporan', [
            'title' => 'Pemerintah | Laporan',
            'laporans' => $laporans,
            'pemerintah' => $pemerintah,
            'initials' => $initials,
            'tahuns' => $tahuns,
            'tahun' => $tahun,
            'musim_tanam' => $musim_tanam,
        ]);
    }
    public function laporan(Request $request): RedirectResponse
    {
        $status_verifikasi = $request->status_verifikasi;
        if($status_verifikasi == 'Terverifikasi'){
            if($this->laporan_service->pemerintahLaporan($request->id, $status_verifikasi)) {
                return redirect('/pemerintah/laporan')->with('success','Berhasil menyetujui laporan kios resmi.');
            } 
        } else if($status_verifikasi == 'Ditolak') {
            if($this->laporan_service->pemerintahLaporan($request->id, $status_verifikasi)) {
                return redirect('/pemerintah/laporan')->with('success','Berhasil menolak laporan kios resmi.');
            } 
        }
        return redirect('/pemerintah/laporan')->withErrors(['error' => 'Gagal mengubah laporan akun.']);
    }
}
