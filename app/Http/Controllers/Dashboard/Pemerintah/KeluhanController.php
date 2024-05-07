<?php

namespace App\Http\Controllers\Dashboard\Pemerintah;

use App\Http\Controllers\Controller;
use App\Http\Requests\PemerintahBalasKeluhanRequest;
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
        $id = Session::get('id_pemerintah',null);
        ['pemerintah' => $pemerintah,
        'initials' =>$initials] = $this->dashboard_service->pemerintahSetSidebar($id); 
        $keluhans = $this->keluhan_service->pemerintahSetKeluhan($id);
        return view('dashboard.pemerintah.pages.keluhan', [
            'title' => 'Pemerintah | Keluhan',
            'pemerintah' => $pemerintah,
            'initials' => $initials,
            'keluhans' => $keluhans
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
