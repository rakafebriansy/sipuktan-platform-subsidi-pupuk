<?php

namespace App\Http\Controllers\Dashboard\Pemerintah;

use App\Http\Controllers\Controller;
use App\Http\Requests\PemerintahBuatAlokasiRequest;
use App\Http\Requests\PemerintahEditAlokasiRequest;
use App\Services\AlokasiService;
use App\Services\DashboardService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AlokasiController extends Controller
{
    private DashboardService $dashboard_service;
    private AlokasiService $alokasi_service;

    public function __construct(DashboardService $dashboard_service, AlokasiService $alokasi_service) {
        $this->dashboard_service = $dashboard_service;
        $this->alokasi_service = $alokasi_service;
    }
    public function setAlokasi(Request $request): View
    {
        $id = Session::get('id_pemerintah',null);
        $tahun = date('Y');
        $musim_tanam = null;
        ['pemerintah' => $pemerintah,'initials' =>$initials] = $this->dashboard_service->pemerintahSetSidebar($id); 
        ['tahuns' => $tahuns, 'jenis_pupuks' => $jenis_pupuks] = $this->alokasi_service->pemerintahSetAlokasi();
        if(isset($request->tahun) && isset($request->musim_tanam)){
            $tahun = $request->tahun;
            $musim_tanam = $request->musim_tanam;
            $alokasis = $this->alokasi_service->pemerintahSetAlokasiByTahun($tahun,$request->musim_tanam);
        } else {
            $alokasis = $this->alokasi_service->pemerintahSetAlokasiByTahun($tahun,'MT1');
        }
        return view('dashboard.pemerintah.pages.alokasi', [
            'title' => 'Pemerintah | Alokasi',
            'pemerintah' => $pemerintah,
            'jenis_pupuks' => $jenis_pupuks,
            'initials' => $initials,
            'tahuns' => $tahuns,
            'alokasis' => $alokasis,
            'tahun' => $tahun,
            'musim_tanam' => $musim_tanam
        ]);
    }
    public function tambahAlokasi(PemerintahBuatAlokasiRequest $request):RedirectResponse
    {
        $validated = $request->validated();
        if($this->alokasi_service->pemerintahTambahAlokasi($validated)) {
            return redirect('/pemerintah/alokasi?tahun=' . $validated['tahun'] . '&musim_tanam=' . $validated['musim_tanam'])->with('success', 'Data alokasi berhasil ditambahkan');
        }
        return redirect('/pemerintah/alokasi?tahun=' . $validated['tahun'] . '&musim_tanam=' . $validated['musim_tanam'])->with(['error' => 'Data alokasi gagal ditambahkan']);
    }
    public function hapusAlokasi(Request $request): RedirectResponse
    {
        if($this->alokasi_service->pemerintahHapusAlokasi($request->id)) {
            return redirect('/pemerintah/alokasi?tahun=' . $request->tahun . '&musim_tanam=' . $request->musim_tanam)->with('success','Data alokasi berhasil dihapus');
        }
        return redirect('/pemerintah/alokasi?tahun=' . $request->tahun . '&musim_tanam=' . $request->musim_tanam)->withErrors(['error' =>'Data alokasi gagal dihapus']);
    }
    public function editAlokasi(PemerintahEditAlokasiRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        if($this->alokasi_service->pemerintahEditAlokasi($validated)) {
            return redirect('/pemerintah/alokasi?tahun=' . $validated['tahun'] . '&musim_tanam=' . $validated['musim_tanam'])->with('success','Data alokasi berhasil diperbarui');
        }
        return redirect('/pemerintah/alokasi?tahun=' . $validated['tahun'] . '&musim_tanam=' . $validated['musim_tanam'])->withErrors(['error','Data alokasi gagal diperbarui']);
    }
}
