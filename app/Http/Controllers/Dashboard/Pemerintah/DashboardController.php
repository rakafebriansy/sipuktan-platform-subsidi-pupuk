<?php

namespace App\Http\Controllers\Dashboard\Pemerintah;

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
        $id = Session::get('id_pemerintah',null);
        ['pemerintah' => $pemerintah,'initials' =>$initials] = $this->dashboard_service->pemerintahSetSidebar($id); 
        return view('dashboard.pemerintah.pages.index', [
            'title' => 'Pemerintah | Dashboard',
            'pemerintah' => $pemerintah,
            'initials' => $initials
        ]);
    }
}
