<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\PetaniRegisterRequest;
use App\Models\Alokasi;
use App\Models\Petani;
use App\Services\AlokasiService;
use App\Services\DashboardService;
use App\Services\RiwayatTransaksiService;
use App\Services\TransaksiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class PetaniController extends Controller
{
    private DashboardService $dashboard_service;
    private AlokasiService $alokasi_service;
    private TransaksiService $transaksi_service;
    private RiwayatTransaksiService $riwayat_transaksi_service;
    public function __construct(DashboardService $dashboard_service, AlokasiService $alokasi_service, TransaksiService $transaksi_service, RiwayatTransaksiService $riwayat_transaksi_service)
    {
        $this->dashboard_service = $dashboard_service;
        $this->alokasi_service = $alokasi_service;
        $this->transaksi_service = $transaksi_service;
        $this->riwayat_transaksi_service = $riwayat_transaksi_service;
    }
    public function setDashboard(): View
    {
        $id = Session::get('id',null);
        ['petani' => $petani,'initials' =>$initials] = $this->dashboard_service->petaniSetSidebar($id);
        return view('dashboard.petani.pages.index', [
            'title' => 'Petani | Dashboard',
            'petani' => $petani,
            'initials' => $initials
        ]);
    }
    public function setAlokasi(): View
    {
        $id = Session::get('id',null);
        ['petani' => $petani,'initials' =>$initials] = $this->dashboard_service->petaniSetSidebar($id);
        $alokasis = $this->alokasi_service->petaniSetAlokasi($id);
        return view('dashboard.petani.pages.alokasi', [
            'title' => 'Petani | Alokasi',
            'petani' => $petani,
            'initials' => $initials,
            'alokasis' => $alokasis
        ]);
    }
    public function setTransaksi(): View
    {
        $id = Session::get('id',null);
        ['petani' => $petani,'initials' =>$initials] = $this->dashboard_service->petaniSetSidebar($id);
        $alokasis = $this->transaksi_service->petaniSetTransaksi($id);
        return view('dashboard.petani.pages.transaksi', [
            'title' => 'Petani | Transaksi',
            'petani' => $petani,
            'initials' => $initials,
            'alokasis' => $alokasis
        ]);
    }
    public function setCheckoutNonTunai(Request $request): View|RedirectResponse
    {
        $petani = Petani::find(Session::get('id'));
        if(isset($request->all()['id_alokasis'])) {
            $all_request = $request->all();
            ['petani' => $petani,'initials' =>$initials] = $this->dashboard_service->petaniSetSidebar($petani->id);
            ['snap_token' => $snap_token, 'alokasis' => $alokasis] = $this->transaksi_service->petaniSetCheckoutNonTunai($all_request['total_harga'], $petani->nama, $all_request['id_alokasis']);
            return view('dashboard.petani.pages.checkout', [
                'title' => 'Petani | Checkout',
                'petani' => $petani,
                'initials' => $initials,
                'alokasis' => $alokasis,
                'id_alokasis' => $all_request['id_alokasis'],
                'snap_token' => $snap_token,
                'total_harga' => $all_request['total_harga']
            ]);
        }
        return redirect('/petani/transaksi')->withErrors(['db' => 'Pilih Pembayaran Yang Tersedia!']);

    }
    public function checkoutNonTunai(Request $request): RedirectResponse
    {
        $id_alokasis = $request->all()['id_alokasis'];
        if ($this->transaksi_service->petaniCheckoutNonTunai($id_alokasis)) {
            return redirect('/petani/transaksi')->with('success','Pembayaran Berhasil!');
        }
        return redirect('/petani/transaksi')->withErrors(['db' => 'Pembayaran Gagal!']);
    }
    public function setRiwayatTransaksi(Request $request): View
    {
        $id = Session::get('id');
        $tahun = intval(date('Y'));
        ['petani' => $petani,'initials' =>$initials] = $this->dashboard_service->petaniSetSidebar($id);
        $tahuns = $this->riwayat_transaksi_service->petaniSetRiwayatTransaksi($id);
        if(isset($request->tahun) && isset($request->musim_tanam)) {
            $tahun = $request->tahun;
            $mt = $request->musim_tanam;
            $riwayat_transaksis = $this->riwayat_transaksi_service->petaniSetRiwayatTransaksiByTahun($id, $tahun);
        } else {
            $riwayat_transaksis = $this->riwayat_transaksi_service->petaniSetRiwayatTransaksiByTahun($id, $tahun);
        }
        return view('dashboard.petani.pages.riwayat-transaksi', [
            'title' => 'Petani | Riwayat Transaksi',
            'petani' => $petani,
            'initials' => $initials,
            'riwayat_transaksis' => $riwayat_transaksis,
            'tahuns' => $tahuns,
        ]);
    }
}
