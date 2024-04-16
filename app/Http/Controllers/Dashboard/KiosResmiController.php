<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\KiosResmi;
use App\Services\AlokasiService;
use App\Services\DashboardService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KiosResmiController extends Controller
{
    private DashboardService $dashboard_service;
    private AlokasiService $alokasi_service;
    public function __construct(DashboardService $dashboard_service, AlokasiService $alokasi_service)
    {
        $this->dashboard_service = $dashboard_service;
        $this->alokasi_service = $alokasi_service;
    }
    public function setDashboard()
    {
        $id = Session::get('id',null);
        ['kios_resmi' => $kios_resmi,'initials' => $initials] = $this->dashboard_service->kiosResmiSetSidebar($id);
        return view('dashboard.kios-resmi.pages.index', [
            'title' => 'Kios Resmi | Dashboard',
            'kios_resmi' => $kios_resmi,
            'initials' => $initials
        ]);
    }
    public function setAlokasi(string $tahun = '2024')
    {
        $id = Session::get('id',null);
        ['kios_resmi' => $kios_resmi,'initials' => $initials] = $this->dashboard_service->kiosResmiSetSidebar($id);
        $alokasis = $this->alokasi_service->kiosResmiSetAlokasiByTahun($id, $tahun);

        return view('dashboard.kios-resmi.pages.alokasi', [
            'title' => 'Kios Resmi | Alokasi',
            'kios_resmi' => $kios_resmi,
            'initials' => $initials,
            'alokasis' => $alokasis
        ]);
    }
}
