<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\KiosResmiLaporanRequest;
use App\Models\KiosResmi;
use App\Models\RiwayatTransaksi;
use App\Services\AlokasiService;
use App\Services\DashboardService;
use App\Services\LaporanService;
use App\Services\RiwayatTransaksiService;
use App\Services\TransaksiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class KiosResmiController extends Controller
{
    private DashboardService $dashboard_service;
    private AlokasiService $alokasi_service;
    private TransaksiService $transaksi_service;
    private RiwayatTransaksiService $riwayat_transaksi_service;
    private LaporanService $laporan_service;
    public function __construct(DashboardService $dashboard_service, AlokasiService $alokasi_service, TransaksiService $transaksi_service, RiwayatTransaksiService $riwayat_transaksi_service, LaporanService $laporan_service)
    {
        $this->dashboard_service = $dashboard_service;
        $this->alokasi_service = $alokasi_service;
        $this->transaksi_service = $transaksi_service;
        $this->riwayat_transaksi_service = $riwayat_transaksi_service;
        $this->laporan_service = $laporan_service;
    }
    public function setDashboard(): View
    {
        $id = Session::get('id',null);
        ['kios_resmi' => $kios_resmi,'initials' => $initials] = $this->dashboard_service->kiosResmiSetSidebar($id);
        return view('dashboard.kios-resmi.pages.index', [
            'title' => 'Kios Resmi | Dashboard',
            'kios_resmi' => $kios_resmi,
            'initials' => $initials
        ]);
    }
    public function setAlokasi(Request $request): View
    {
        $id = Session::get('id',null);
        $tahun = date('Y');
        $mt = null;
        ['kios_resmi' => $kios_resmi,'initials' =>$initials] = $this->dashboard_service->kiosResmiSetSidebar($id); 
        $tahuns = $this->alokasi_service->kiosResmiSetAlokasi();
        if(isset($request->tahun) && isset($request->musim_tanam)){
            $tahun = $request->tahun;
            $mt = $request->musim_tanam;
            $alokasis = $this->alokasi_service->kiosResmiSetAlokasiByTahun($id,$tahun,$request->musim_tanam);
        } else {
            $alokasis = $this->alokasi_service->kiosResmiSetAlokasiByTahun($id,$tahun,'MT1');
        }
        return view('dashboard.kios-resmi.pages.alokasi', [
            'title' => 'Kios Resmi | Alokasi',
            'kios_resmi' => $kios_resmi,
            'initials' => $initials,
            'tahuns' => $tahuns,
            'alokasis' => $alokasis,
            'tahun' => $tahun,
            'mt' => $mt
        ]);
    }
    public function setTransaksi(): View
    {
        $id = Session::get('id',null);
        ['kios_resmi' => $kios_resmi,'initials' =>$initials] = $this->dashboard_service->kiosResmiSetSidebar($id);
        $alokasis = $this->transaksi_service->kiosResmiSetTransaksi($id);
        return view('dashboard.kios-resmi.pages.transaksi', [
            'title' => 'Kios Resmi | Transaksi',
            'kios_resmi' => $kios_resmi,
            'initials' => $initials,
            'alokasis' => $alokasis
        ]);
    }
    public function transaksi(Request $request): RedirectResponse
    {
        if(isset($request->all()['id_alokasis'])) {
            $id_alokasis = $request->all()['id_alokasis'];
            if ($this->transaksi_service->kiosResmiTransaksi($id_alokasis)) {
                return redirect('/kios-resmi/transaksi')->with('success','Pupuk Berhasil Lunas!');
            }
        }
        return redirect('/kios-resmi/transaksi')->withErrors(['db' => 'Pilih Pembayaran Yang Tersedia!']);
    }
    public function setRiwayatTransaksi(Request $request): View
    {
        $id = Session::get('id');
        $tahun = date('Y');
        $musim_tanam = null;
        ['kios_resmi' => $kios_resmi,'initials' =>$initials] = $this->dashboard_service->kiosResmiSetSidebar($id);
        $tahuns = $this->riwayat_transaksi_service->kiosResmiSetRiwayatTransaksi($id);
        if(isset($request->tahun) && isset($request->musim_tanam)) {
            $tahun = $request->tahun;
            $musim_tanam = $request->musim_tanam;
            $riwayat_transaksis = $this->riwayat_transaksi_service->kiosResmiSetRiwayatTransaksiByTahun($id, $tahun, $musim_tanam);
        } else {
            $riwayat_transaksis = $this->riwayat_transaksi_service->kiosResmiSetRiwayatTransaksiByTahun($id, $tahun, 'MT1');
        }
        return view('dashboard.kios-resmi.pages.riwayat-transaksi', [
            'title' => 'Kios Resmi | Riwayat Transaksi',
            'kios_resmi' => $kios_resmi,
            'initials' => $initials,
            'riwayat_transaksis' => $riwayat_transaksis,
            'tahuns' => $tahuns,
            'tahun' => $tahun,
            'mt' => $musim_tanam
        ]);
    }
    public function setLaporan(Request $request): View
    {
        $id = Session::get('id');
        $tahun = date('Y');
        $musim_tanam = null;
        ['kios_resmi' => $kios_resmi,'initials' =>$initials] = $this->dashboard_service->kiosResmiSetSidebar($id);
        $tahuns = $this->laporan_service->kiosResmiSetLaporan($id);
        if(isset($request->tahun) && isset($request->musim_tanam)) {
            $tahun = $request->tahun;
            $musim_tanam = $request->musim_tanam;
            $laporans = $this->laporan_service->kiosResmiSetLaporanByTahun($id, $tahun, $musim_tanam);
        } else {
            $laporans = $this->laporan_service->kiosResmiSetLaporanByTahun($id, $tahun, 'MT1');
        }
        return view('dashboard.kios-resmi.pages.laporan', [
            'title' => 'Kios Resmi | Laporan',
            'kios_resmi' => $kios_resmi,
            'initials' => $initials,
            'laporans' => $laporans,
            'tahuns' => $tahuns,
            'tahun' => $tahun,
            'musim_tanam' => $musim_tanam
        ]);
    }
    public function laporan(KiosResmiLaporanRequest $request)
    {
        $validated = $request->validated();
        if($this->laporan_service->kiosResmiLaporan($validated)) {
            return redirect('/kios-resmi/laporan?tahun=' . $request->tahun . '&musim_tanam=' . $request->musim_tanam)->with('success', 'Data laporan berhasil ditambahkan');
        }
        return redirect('/kios-resmi/laporan?tahun=' . $request->tahun . '&musim_tanam=' . $request->musim_tanam)->with(['error' => 'Data laporan gagal ditambahkan']);
    }
}
