<?php

namespace App\Http\Controllers\Dashboard\Petani;

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
    public function setDashboard(AlokasiPupukSubsidiPerTahunChart $alokasi_chart): View
    {
        $id = Auth::guard('petani')->user()->id;
        ['petani' => $petani, 
        'notifikasis' => $notifikasis, 
        'initials' =>$initials] = $this->dashboard_service->petaniSetSidebar($id);
        return view('dashboard.petani.pages.index', [
            'title' => 'Petani | Dashboard',
            'petani' => $petani,
            'notifikasis' => $notifikasis,
            'initials' => $initials,
            'alokasi_chart' => $alokasi_chart->build()
        ]);
    }
}
