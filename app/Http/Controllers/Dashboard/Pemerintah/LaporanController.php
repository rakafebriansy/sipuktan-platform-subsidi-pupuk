<?php

namespace App\Http\Controllers\Dashboard\Pemerintah;

use App\Events\LaporanStatusToDitolak;
use App\Events\LaporanStatusToDiverifikasi;
use App\Http\Controllers\Controller;
use App\Http\Requests\PemerintahLaporanRequest;
use App\Http\Requests\PemerintahSetujuiLaporanRequest;
use App\Http\Requests\PemerintahTolakLaporanRequest;
use App\Models\Alokasi;
use App\Models\Laporan;
use App\Services\DashboardService;
use App\Services\LaporanService;
use App\Services\NotifikasiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $id = Auth::guard('pemerintah')->user()->id;
        $tahun = date('Y');
        $musim_tanam = null;
        ['pemerintah' => $pemerintah,
        'initials' =>$initials] = $this->dashboard_service->pemerintahSetSidebar($id);
        ['saat_ini' => $saat_ini,
        'tahuns' => $tahuns] = $this->laporan_service->pemerintahSetLaporan();
        if(isset($request->tahun) && isset($request->musim_tanam)){
            $tahun = $request->tahun;
            $musim_tanam = $request->musim_tanam;
            $laporans = $this->laporan_service->pemerintahSetLaporanByTahun($tahun, $musim_tanam);
        } else {
            $musim_tanam = $saat_ini->musim_tanam;
            $laporans = $this->laporan_service->pemerintahSetLaporanByTahun($saat_ini->tahun, $saat_ini->musim_tanam);
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
    public function setujuiLaporan(PemerintahSetujuiLaporanRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $id_kios_resmi = $this->laporan_service->pemerintahGetIdKiosResmiByLaporan($validated['id']);
        if($this->laporan_service->pemerintahSetujuiLaporan($validated['id'])) {
            $pesan = 'Laporan telah diverifikasi.';
            $id_notifikasi = $this->notifikasi_service->sendNotifikasi($pesan, 'kios_resmi', $id_kios_resmi);
            $data_notifikasi = [
                'pesan' => $pesan, 
                'id' => $id_notifikasi,
                'id_kios_resmi' => $id_kios_resmi
            ];
            event(new LaporanStatusToDiverifikasi($data_notifikasi));
            return back()->with('success','Berhasil menyetujui laporan kios resmi.');
        }
        return back()->withErrors(['failed'=>'Gagal mengubah status laporan kios resmi.']);
    }
    public function tolakLaporan(PemerintahTolakLaporanRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $id_kios_resmi = $this->laporan_service->pemerintahGetIdKiosResmiByLaporan($validated['id']);
        if($this->laporan_service->pemerintahTolakLaporan($validated['id'], $validated['catatan'])) {
            $pesan = 'Laporan anda ditolak!<span class="block">'.$validated['catatan'].'.</span>';
            $id_notifikasi = $this->notifikasi_service->sendNotifikasi($pesan, 'kios_resmi', $id_kios_resmi);
            $data_notifikasi = [
                'pesan' => $pesan, 
                'id' => $id_notifikasi,
                'id_kios_resmi' => $id_kios_resmi,
                'id_laporan' => $validated['id']
            ];
            event(new LaporanStatusToDitolak($data_notifikasi));
            return back()->with('success','Berhasil menolak laporan kios resmi.');
        } 
        return back()->withErrors(['failed'=>'Gagal mengubah status laporan kios resmi.']);
    }
}
