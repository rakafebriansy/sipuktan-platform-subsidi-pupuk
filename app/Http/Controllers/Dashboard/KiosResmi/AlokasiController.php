<?php

namespace App\Http\Controllers\Dashboard\KiosResmi;

use App\Events\AlokasiStatusChanged;
use App\Events\AlokasiStatusToMenungguPembayaran;
use App\Http\Controllers\Controller;
use App\Services\AlokasiService;
use App\Services\DashboardService;
use App\Services\NotifikasiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AlokasiController extends Controller
{
    private DashboardService $dashboard_service;
    private AlokasiService $alokasi_service;
    private NotifikasiService $notifikasi_service;
    public function __construct(DashboardService $dashboard_service, AlokasiService $alokasi_service, NotifikasiService $notifikasi_service)
    {
        $this->dashboard_service = $dashboard_service;
        $this->alokasi_service = $alokasi_service;
        $this->notifikasi_service = $notifikasi_service;
    }

    public function setAlokasi(Request $request): View
    {
        $id = Auth::guard('kiosResmi')->user()->id;
        $tahun = date('Y');
        $musim_tanam = null;
        ['kios_resmi' => $kios_resmi,
        'notifikasis' => $notifikasis,
        'initials' =>$initials] = $this->dashboard_service->kiosResmiSetSidebar($id); 
        ['saat_ini' => $saat_ini, 
        'tahuns' => $tahuns] = $this->alokasi_service->kiosResmiSetAlokasi($id);
        if(isset($request->tahun) && isset($request->musim_tanam)){
            $tahun = $request->tahun;
            $musim_tanam = $request->musim_tanam;
            $alokasis = $this->alokasi_service->kiosResmiSetAlokasiByTahun($id,$tahun,$request->musim_tanam);
        } else {
            $musim_tanam = $saat_ini->musim_tanam;
            $alokasis = $this->alokasi_service->kiosResmiSetAlokasiByTahun($id,$saat_ini->tahun,$saat_ini->musim_tanam);
        }
        return view('dashboard.kios-resmi.pages.alokasi', [
            'title' => 'Kios Resmi | Alokasi',
            'kios_resmi' => $kios_resmi,
            'initials' => $initials,
            'tahuns' => $tahuns,
            'notifikasis' => $notifikasis,
            'alokasis' => $alokasis,
            'tahun' => $tahun,
            'musim_tanam' => $musim_tanam
        ]);
    }
    public function alokasi(Request $request): RedirectResponse
    {
        $tahun = $request->tahun;
        $musim_tanam = $request->musim_tanam;
        if(!isset($request->id_alokasis)) {
            return back()->withErrors(['error' => 'Tidak ada pupuk yang dipilih.']);
        }
        $ids = explode(',',$request->id_alokasis);
        if ($this->alokasi_service->kiosResmiAlokasi($ids)) {
            $pesan = 'Pupuk anda telah datang!';
            $id_petanis = $this->alokasi_service->kiosResmiGetDistinctIdPetaniByTahunMusimTanam($tahun, $musim_tanam);
            $detail_notifikasis = $this->notifikasi_service->sendManyNotifikasi($pesan, 'petani', $id_petanis);
            if(count($detail_notifikasis)) {
                foreach ($detail_notifikasis as $detail_notifikasi) {
                    $data_notifikasi = ['pesan' => $pesan,'detail_notifikasi' => $detail_notifikasi];
                    event(new AlokasiStatusToMenungguPembayaran($data_notifikasi));
                }
                return back()->with('success','Kedatangan pupuk berhasil dikonfirmasi.');
            }
        }
        return back()->withErrors(['error' => 'Kedatangan pupuk sudah dikonfirmasi sebelumnya.']);
    }
}
