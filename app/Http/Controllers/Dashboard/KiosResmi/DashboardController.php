<?php

namespace App\Http\Controllers\Dashboard\KiosResmi;

use App\Charts\AlokasiPupukSubsidiPerTahunChart;
use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class DashboardController extends Controller
{
    private DashboardService $dashboard_service;
    public function __construct(DashboardService $dashboard_service) {
        $this->dashboard_service = $dashboard_service;
    }
    public function setDashboard(): View
    {
        $id = Auth::guard('kiosResmi')->user()->id;
        $alokasis_chart = $this->dashboard_service->setPieChart();
        ['kios_resmi' => $kios_resmi, 
        'notifikasis' => $notifikasis, 
        'initials' => $initials] = $this->dashboard_service->kiosResmiSetSidebar($id);
        return view('dashboard.kios-resmi.pages.index', [
            'title' => 'Kios Resmi | Dashboard',
            'kios_resmi' => $kios_resmi,
            'notifikasis' => $notifikasis,
            'initials' => $initials,
            'alokasis_chart' => $alokasis_chart,
        ]);
    }
}
