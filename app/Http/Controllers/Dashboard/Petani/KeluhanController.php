<?php

namespace App\Http\Controllers\Dashboard\Petani;

use App\Events\KeluhanDibuat;
use App\Http\Controllers\Controller;
use App\Http\Requests\PetaniKeluhanRequest;
use App\Services\DashboardService;
use App\Services\KeluhanService;
use App\Services\NotifikasiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class KeluhanController extends Controller
{
    private DashboardService $dashboard_service;
    private KeluhanService $keluhan_service;
    private NotifikasiService $notifikasi_service;
    public function __construct(DashboardService $dashboard_service, KeluhanService $keluhan_service, NotifikasiService $notifikasi_service) 
    {
        $this->dashboard_service = $dashboard_service;
        $this->keluhan_service = $keluhan_service;
        $this->notifikasi_service = $notifikasi_service;
    }
    public function setKeluhan(): View
    {
        $id = Auth::guard('petani')->user()->id;
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
        $id = Auth::guard('petani')->user()->id;
        $nama = Auth::guard('petani')->user()->nama;
        $validated = $request->validated();
        $id_keluhan = $this->keluhan_service->petaniBuatKeluhan($validated,$id);
        if(isset($id_keluhan)) {
            $pesan = 'Keluhan dari petani '.$nama.' terkait '.$validated['subjek'].'.';
            $id_notifikasi = $this->notifikasi_service->sendNotifikasi($pesan, 'pemerintah', 1);
            $data_notifikasi = [
                'pesan' => $pesan, 
                'id' => $id_notifikasi,
                'id_keluhan' => $id_keluhan,
            ];
            event(new KeluhanDibuat($data_notifikasi));
            return back()->with('success', 'Keluhan berhasil ditambahkan');
        }
        return back()->withInput()->with(['error' => 'Keluhan gagal ditambahkan']);
    }
}
