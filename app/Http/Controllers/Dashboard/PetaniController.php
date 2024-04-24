<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PetaniRegisterRequest;
use App\Models\Alokasi;
use App\Models\Petani;
use App\Services\AlokasiService;
use App\Services\DashboardService;
use App\Services\TransaksiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class PetaniController extends Controller
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
        ['petani' => $petani,'initials' =>$initials] = $this->dashboard_service->petaniSetSidebar($id);
        return view('dashboard.petani.pages.index', [
            'title' => 'Petani | Dashboard',
            'petani' => $petani,
            'initials' => $initials
        ]);
    }
    public function setAlokasi()
    {
        $id = Session::get('id',null);
        ['petani' => $petani,'initials' =>$initials] = $this->dashboard_service->petaniSetSidebar($id);
        $alokasis = $this->alokasi_service->petaniSetAlokasi($id);
        return view('dashboard.petani.pages.alokasi', [
            'title' => 'Petani | Alokasi',
            'petani' => $petani,
            'initials' => $initials,
            'alokasis' => $alokasis
        ]);
    }
    public function setTransaksi()
    {
        $id = Session::get('id',null);
        ['petani' => $petani,'initials' =>$initials] = $this->dashboard_service->petaniSetSidebar($id);
        $alokasis = $this->transaksi_service->petaniSetTransaksi($id);
        return view('dashboard.petani.pages.transaksi', [
            'title' => 'Petani | Transaksi',
            'petani' => $petani,
            'initials' => $initials,
            'alokasis' => $alokasis
        ]);
    }
}
