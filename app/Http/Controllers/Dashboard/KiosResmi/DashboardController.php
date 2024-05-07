<?php

namespace App\Http\Controllers\Dashboard\KiosResmi;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
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
        $id = Session::get('id_kios_resmi',null);
        ['kios_resmi' => $kios_resmi, 
        'notifikasis' => $notifikasis, 
        'initials' => $initials] = $this->dashboard_service->kiosResmiSetSidebar($id);
        return view('dashboard.kios-resmi.pages.index', [
            'title' => 'Kios Resmi | Dashboard',
            'kios_resmi' => $kios_resmi,
            'notifikasis' => $notifikasis,
            'initials' => $initials
        ]);
    }
}
