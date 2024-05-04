<?php

namespace App\Http\Controllers\Dashboard\Petani;

use App\Http\Controllers\Controller;
use App\Services\AlokasiService;
use App\Services\DashboardService;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AlokasiController extends Controller
{
    private DashboardService $dashboard_service;
    private AlokasiService $alokasi_service;
    public function __construct(AlokasiService $alokasi_service, DashboardService $dashboard_service) {
        $this->alokasi_service = $alokasi_service;
        $this->dashboard_service = $dashboard_service;
    }
    public function setAlokasi(): View
    {
        $id = Session::get('id_petani',null);
        ['petani' => $petani, 'notifikasis' => $notifikasis, 'initials' =>$initials] = $this->dashboard_service->petaniSetSidebar($id);
        $alokasis = $this->alokasi_service->petaniSetAlokasi($id);
        return view('dashboard.petani.pages.alokasi', [
            'title' => 'Petani | Alokasi',
            'petani' => $petani,
            'notifikasis' => $notifikasis,
            'initials' => $initials,
            'alokasis' => $alokasis
        ]);
    }
}
