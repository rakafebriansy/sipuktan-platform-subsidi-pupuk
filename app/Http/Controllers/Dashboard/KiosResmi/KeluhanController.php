<?php

namespace App\Http\Controllers\Dashboard\KiosResmi;

use App\Http\Controllers\Controller;
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
        $keluhans = $this->keluhan_service->pemerintahSetKeluhan($id);
        return view('dashboard.kios-resmi.pages.index', [
            'title' => 'Kios Resmi | Dashboard',
            'kios_resmi' => $kios_resmi,
            'notifikasis' => $notifikasis,
            'initials' => $initials
        ]);
    }
    public function balasKeluhan(PemerintahBalasKeluhanRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        if($this->keluhan_service->pemerintahBalasKeluhan($validated['balasan'],$validated['id'])) {
            return back()->with('success', 'Balasan keluhan berhasil ditambahkan');
        }
        return back()->with(['error' => 'Balasan keluhan gagal ditambahkan']);
    }
}
