<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\KiosResmi;
use App\Services\AlokasiService;
use App\Services\DashboardService;
use App\Services\TransaksiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class KiosResmiController extends Controller
{
    private DashboardService $dashboard_service;
    private AlokasiService $alokasi_service;
    private TransaksiService $transaksi_service;
    public function __construct(DashboardService $dashboard_service, AlokasiService $alokasi_service, TransaksiService $transaksi_service)
    {
        $this->dashboard_service = $dashboard_service;
        $this->alokasi_service = $alokasi_service;
        $this->transaksi_service = $transaksi_service;
    }
    public function setDashboard(): View
    {
        $id = Session::get('id',null);
        ['kios_resmi' => $kios_resmi,'initials' => $initials] = $this->dashboard_service->kiosResmiSetSidebar($id);
        return view('dashboard.kios-resmi.pages.index', [
            'title' => 'Kios Resmi | Dashboard',
            'kios_resmi' => $kios_resmi,
            'initials' => $initials
        ]);
    }
    public function setAlokasi(Request $request): View
    {
        $id = Session::get('id',null);
        $tahun = null;
        $mt = null;
        ['kios_resmi' => $kios_resmi,'initials' =>$initials] = $this->dashboard_service->kiosResmiSetSidebar($id); 
        $tahuns = $this->alokasi_service->kiosResmiSetAlokasi();
        if(isset($request->tahun) && isset($request->musim_tanam)){
            $tahun = $request->tahun;
            $mt = $request->musim_tanam;
            $alokasis = $this->alokasi_service->kiosResmiSetAlokasiByTahun($id,$tahun,$request->musim_tanam);
        } else {
            $alokasis = $this->alokasi_service->kiosResmiSetAlokasiByTahun($id,$tahuns[0]->tahun,'MT1');
        }
        return view('dashboard.kios-resmi.pages.alokasi', [
            'title' => 'Kios Resmi | Alokasi',
            'kios_resmi' => $kios_resmi,
            'initials' => $initials,
            'tahuns' => $tahuns,
            'alokasis' => $alokasis,
            'tahun' => $tahun,
            'mt' => $mt
        ]);
    }
    public function setTransaksi(): View
    {
        $id = Session::get('id',null);
        ['kios_resmi' => $kios_resmi,'initials' =>$initials] = $this->dashboard_service->kiosResmiSetSidebar($id);
        $alokasis = $this->transaksi_service->kiosResmiSetTransaksi($id);
        return view('dashboard.kios-resmi.pages.transaksi', [
            'title' => 'Kios Resmi | Transaksi',
            'kios_resmi' => $kios_resmi,
            'initials' => $initials,
            'alokasis' => $alokasis
        ]);
    }
}
