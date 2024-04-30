<?php

namespace App\Http\Controllers\Dashboard\KiosResmi;

use App\Http\Controllers\Controller;
use App\Services\AlokasiService;
use App\Services\DashboardService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AlokasiController extends Controller
{
    private DashboardService $dashboard_service;
    private AlokasiService $alokasi_service;
    public function __construct(DashboardService $dashboard_service, AlokasiService $alokasi_service)
    {
        $this->dashboard_service = $dashboard_service;
        $this->alokasi_service = $alokasi_service;
    }

    public function setAlokasi(Request $request): View
    {
        $id = Session::get('id',null);
        $tahun = date('Y');
        $musim_tanam = null;
        ['kios_resmi' => $kios_resmi,'initials' =>$initials] = $this->dashboard_service->kiosResmiSetSidebar($id); 
        $tahuns = $this->alokasi_service->kiosResmiSetAlokasi();
        if(isset($request->tahun) && isset($request->musim_tanam)){
            $tahun = $request->tahun;
            $musim_tanam = $request->musim_tanam;
            $alokasis = $this->alokasi_service->kiosResmiSetAlokasiByTahun($id,$tahun,$request->musim_tanam);
        } else {
            $alokasis = $this->alokasi_service->kiosResmiSetAlokasiByTahun($id,$tahun,'MT1');
        }
        return view('dashboard.kios-resmi.pages.alokasi', [
            'title' => 'Kios Resmi | Alokasi',
            'kios_resmi' => $kios_resmi,
            'initials' => $initials,
            'tahuns' => $tahuns,
            'alokasis' => $alokasis,
            'tahun' => $tahun,
            'musim_tanam' => $musim_tanam
        ]);
    }
    public function alokasi(Request $request): RedirectResponse
    {
        if ($this->alokasi_service->kiosResmiAlokasi($request->tahun, $request->musim_tanam)) {
            return redirect('/kios-resmi/alokasi?tahun=' . $request->tahun . '&musim_tanam=' . $request->musim_tanam)->with('success','Kedatangan pupuk berhasil dikonfirmasi.');
        }
        return redirect('/kios-resmi/alokasi?tahun=' . $request->tahun . '&musim_tanam=' . $request->musim_tanam)->withErrors(['db' => 'Kedatangan pupuk sudah dikonfirmasi sebelumnya.']);
    }
}
