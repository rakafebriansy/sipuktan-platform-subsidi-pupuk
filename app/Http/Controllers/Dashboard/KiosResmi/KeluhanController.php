<?php

namespace App\Http\Controllers\Dashboard\KiosResmi;

use App\Http\Controllers\Controller;
use App\Http\Requests\KiosResmiKeluhanRequest;
use App\Services\DashboardService;
use App\Services\KeluhanService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class KeluhanController extends Controller
{
    private DashboardService $dashboard_service;
    private KeluhanService $keluhan_service;
    public function __construct(DashboardService $dashboard_service, KeluhanService $keluhan_service) 
    {
        $this->dashboard_service = $dashboard_service;
        $this->keluhan_service = $keluhan_service;
    }
    public function setKeluhan(): View
    {
        $id = Session::get('id_kios_resmi',null);
        ['kios_resmi' => $kios_resmi, 
        'notifikasis' => $notifikasis, 
        'initials' => $initials] = $this->dashboard_service->kiosResmiSetSidebar($id); 
        $keluhans = $this->keluhan_service->kiosResmiSetKeluhan($id);
        return view('dashboard.kios-resmi.pages.keluhan', [
            'title' => 'Kios Resmi | Keluhan',
            'kios_resmi' => $kios_resmi,
            'notifikasis' => $notifikasis,
            'initials' => $initials,
            'keluhans' => $keluhans
        ]);
    }
    public function buatKeluhan(KiosResmiKeluhanRequest $request): RedirectResponse
    {
        $id = Session::get('id_kios_resmi');
        $validated = $request->validated();
        if($this->keluhan_service->kiosResmiBuatKeluhan($validated,$id)) {
            return back()->with('success', 'Keluhan berhasil ditambahkan');
        }
        return back()->withInput()->with(['error' => 'Keluhan gagal ditambahkan']);
    }
}
