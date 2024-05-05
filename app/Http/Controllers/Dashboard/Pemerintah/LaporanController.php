<?php

namespace App\Http\Controllers\Dashboard\Pemerintah;

use App\Events\LaporanStatusToDitolak;
use App\Events\LaporanStatusToDiverifikasi;
use App\Http\Controllers\Controller;
use App\Models\Alokasi;
use App\Models\Laporan;
use App\Services\DashboardService;
use App\Services\LaporanService;
use App\Services\NotifikasiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class LaporanController extends Controller
{
    private DashboardService $dashboard_service;
    private LaporanService $laporan_service;
    private NotifikasiService $notifikasi_service;
    public function __construct(DashboardService $dashboard_service, LaporanService $laporan_service, NotifikasiService $notifikasi_service) {
        $this->dashboard_service = $dashboard_service;
        $this->laporan_service = $laporan_service;
        $this->notifikasi_service = $notifikasi_service;
    }
    public function setLaporan(Request $request): View
    {
        $id = Session::get('id_pemerintah');
        $tahun = date('Y');
        $musim_tanam = null;
        ['pemerintah' => $pemerintah,
        'initials' =>$initials] = $this->dashboard_service->pemerintahSetSidebar($id);
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
        $id_kios_resmi = $this->laporan_service->pemerintahGetIdKiosResmiByLaporan($request->id);
        if($status_verifikasi == 'Terverifikasi'){
            if($this->laporan_service->pemerintahLaporan($request->id, $status_verifikasi)) {
                $pesan = 'Laporan telah diverifikasi.';
                $id_notifikasi = $this->notifikasi_service->sendNotifikasi($pesan, 'kios_resmi', $id_kios_resmi);
                $data_notifikasi = [
                    'pesan' => $pesan, 
                    'id' => $id_notifikasi,
                    'id_kios_resmi' => $id_kios_resmi
                ];
                event(new LaporanStatusToDiverifikasi($data_notifikasi));
                return redirect('/pemerintah/laporan?tahun=' . $request->tahun . '&musim_tanam=' . $request->musim_tanam)->with('success','Berhasil menyetujui laporan kios resmi.');
            } 
        } else if($status_verifikasi == 'Ditolak') {
            if($this->laporan_service->pemerintahLaporan($request->id, $status_verifikasi)) {
                $pesan = 'Laporan telah ditolak.';
                $id_notifikasi = $this->notifikasi_service->sendNotifikasi($pesan, 'kios_resmi', $id_kios_resmi);
                $data_notifikasi = [
                    'pesan' => $pesan, 
                    'id' => $id_notifikasi,
                    'id_kios_resmi' => $id_kios_resmi
                ];
                event(new LaporanStatusToDitolak($data_notifikasi));
                return redirect('/pemerintah/laporan?tahun=' . $request->tahun . '&musim_tanam=' . $request->musim_tanam)->with('success','Berhasil menolak laporan kios resmi.');
            } 
        }
        return redirect('/pemerintah/laporan?tahun=' . $request->tahun . '&musim_tanam=' . $request->musim_tanam)->withErrors(['failed'=>'Gagal mengubah status laporan kios resmi.']);
    }
}
