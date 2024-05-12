<?php

namespace App\Http\Controllers\Dashboard\KiosResmi;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use App\Services\TransaksiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class TransaksiController extends Controller
{
    private DashboardService $dashboard_service;
    private TransaksiService $transaksi_service;
    public function __construct(DashboardService $dashboard_service, TransaksiService $transaksi_service) {
        $this->dashboard_service = $dashboard_service;
        $this->transaksi_service = $transaksi_service;
    }
    public function setTransaksi(): View
    {
        $id = Auth::guard('kiosResmi')->user()->id;
        ['kios_resmi' => $kios_resmi,'notifikasis' => $notifikasis,'initials' =>$initials] = $this->dashboard_service->kiosResmiSetSidebar($id);
        $alokasis = $this->transaksi_service->kiosResmiSetTransaksi($id);
        return view('dashboard.kios-resmi.pages.transaksi', [
            'title' => 'Kios Resmi | Transaksi',
            'kios_resmi' => $kios_resmi,
            'notifikasis' => $notifikasis,
            'initials' => $initials,
            'alokasis' => $alokasis
        ]);
    }
    public function transaksi(Request $request): RedirectResponse
    {
        if(isset($request->id_alokasis)) {
            $id_alokasis = $request->all()['id_alokasis'];
            if ($this->transaksi_service->kiosResmiTransaksi($id_alokasis)) {
                return redirect('/kios-resmi/transaksi')->with('success','Pupuk Berhasil Lunas.');
            }
        }
        return redirect('/kios-resmi/transaksi')->withErrors(['db' => 'Pilih Pembayaran Yang Tersedia.']);
    }
    public function setRiwayatTransaksi(Request $request): View
    {
        $id = Auth::guard('kiosResmi')->user()->id;
        $tahun = date('Y');
        $musim_tanam = null;
        ['kios_resmi' => $kios_resmi,'notifikasis' => $notifikasis,'initials' =>$initials] = $this->dashboard_service->kiosResmiSetSidebar($id);
        $tahuns = $this->transaksi_service->kiosResmiSetRiwayatTransaksi($id);
        if(isset($request->tahun) && isset($request->musim_tanam)) {
            $tahun = $request->tahun;
            $musim_tanam = $request->musim_tanam;
            $riwayat_transaksis = $this->transaksi_service->kiosResmiSetRiwayatTransaksiByTahun($id, $tahun, $musim_tanam);
        } else {
            $riwayat_transaksis = $this->transaksi_service->kiosResmiSetRiwayatTransaksiByTahun($id, $tahun, 'MT1');
        }
        return view('dashboard.kios-resmi.pages.riwayat-transaksi', [
            'title' => 'Kios Resmi | Riwayat Transaksi',
            'kios_resmi' => $kios_resmi,
            'initials' => $initials,
            'notifikasis' => $notifikasis,
            'riwayat_transaksis' => $riwayat_transaksis,
            'tahuns' => $tahuns,
            'tahun' => $tahun,
            'mt' => $musim_tanam
        ]);
    }
}
