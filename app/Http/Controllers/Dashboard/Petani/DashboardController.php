<?php

namespace App\Http\Controllers\Dashboard\Petani;

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
        $id = Session::get('id_petani',null);
        ['petani' => $petani, 
        'notifikasis' => $notifikasis, 
        'initials' =>$initials] = $this->dashboard_service->petaniSetSidebar($id);
        return view('dashboard.petani.pages.index', [
            'title' => 'Petani | Dashboard',
            'petani' => $petani,
            'notifikasis' => $notifikasis,
            'initials' => $initials
        ]);
    }
}
