<?php

namespace App\Http\Controllers\Dashboard\Pemerintah;

use App\Http\Controllers\Controller;
use App\Http\Requests\PemerintahBuatKelompokTaniRequest;
use App\Services\CrudService;
use App\Services\DashboardService;
use Illuminate\Support\Facades\Auth;

class KelompokTaniController extends Controller
{
    private DashboardService $dashboard_service;
    private CrudService $crud_service;
    public function __construct(DashboardService $dashboard_service, CrudService $crud_service) {
        $this->dashboard_service = $dashboard_service;
        $this->crud_service = $crud_service;
    }
    public function setKelompokTani()
    {
        $id = Auth::guard('pemerintah')->user()->id;
        ['pemerintah' => $pemerintah,
        'notifikasis' => $notifikasis,
        'initials' =>$initials] = $this->dashboard_service->pemerintahSetSidebar($id); 
        $kelompok_tanis = $this->crud_service->pemerintahSetKelompokTani();
        return view('dashboard.pemerintah.pages.kelompok-tani', [
            'title' => 'Pemerintah | Kelompok Tani',
            'notifikasis' => $notifikasis,
            'pemerintah' => $pemerintah,
            'initials' => $initials,
            'kelompok_tanis' => $kelompok_tanis
        ]);
    }
    public function buatKelompokTani(PemerintahBuatKelompokTaniRequest $request)
    {
        $id = Auth::guard('pemerintah')->user()->id;
        $validated = $request->validated();
        if($this->crud_service->pemerintahBuatKelompokTani($validated)) {
            return back()->with('success', 'Kelompok tani berhasil ditambahkan');
        }
        return back()->withInput()->withErrors(['error' => 'Kelompok tani gagal ditambahkan']);
    }
}
