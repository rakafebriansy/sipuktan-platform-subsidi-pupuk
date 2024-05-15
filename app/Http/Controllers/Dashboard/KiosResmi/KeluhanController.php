<?php

namespace App\Http\Controllers\Dashboard\KiosResmi;

use App\Events\KeluhanDibuat;
use App\Http\Controllers\Controller;
use App\Http\Requests\KiosResmiKeluhanRequest;
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
        $id = Auth::guard('kiosResmi')->user()->id;
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
        $id = Auth::guard('kiosResmi')->user()->id;
        $nama = Auth::guard('kiosResmi')->user()->nama;
        $validated = $request->validated();
        $id_keluhan = $this->keluhan_service->kiosResmiBuatKeluhan($validated,$id);
        if(isset($id_keluhan)) {
            $pesan = 'Keluhan dari kios '.$nama.' terkait '.$validated['subjek'].'.';
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
