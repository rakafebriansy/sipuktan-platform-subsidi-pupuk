<?php

namespace App\Http\Controllers\Dashboard\Petani;

use App\Http\Controllers\Controller;
use App\Http\Requests\PetaniKeluhanRequest;
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
        $id = Session::get('id_petani',null);
        ['petani' => $petani, 
        'notifikasis' => $notifikasis, 
        'initials' =>$initials] = $this->dashboard_service->petaniSetSidebar($id);
        $keluhans = $this->keluhan_service->petaniSetKeluhan($id);
        return view('dashboard.petani.pages.keluhan', [
            'title' => 'Petani | Keluhan',
            'petani' => $petani,
            'notifikasis' => $notifikasis,
            'initials' => $initials,
            'keluhans' => $keluhans
        ]);
    }
    public function buatKeluhan(PetaniKeluhanRequest $request): RedirectResponse
    {
        $id = Session::get('id_petani');
        $validated = $request->validated();
        if($this->keluhan_service->petaniBuatKeluhan($validated,$id)) {
            return back()->with('success', 'Keluhan berhasil ditambahkan');
        }
        return back()->withInput()->with(['error' => 'Keluhan gagal ditambahkan']);
    }
}
