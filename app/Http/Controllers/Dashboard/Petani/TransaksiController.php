<?php

namespace App\Http\Controllers\Dashboard\Petani;

use App\Http\Controllers\Controller;
use App\Models\Petani;
use App\Services\DashboardService;
use App\Services\TransaksiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class TransaksiController extends Controller
{
    private DashboardService $dashboard_service;
    private TransaksiService $transaksi_service;
    public function __construct(TransaksiService $transaksi_service, DashboardService $dashboard_service) {
        $this->transaksi_service = $transaksi_service;
        $this->dashboard_service = $dashboard_service;
    }
    public function setTransaksi(): View
    {
        $id = Session::get('id',null);
        ['petani' => $petani, 
        'notifikasis' => $notifikasis, 
        'initials' =>$initials] = $this->dashboard_service->petaniSetSidebar($id);
        $alokasis = $this->transaksi_service->petaniSetTransaksi($id);
        return view('dashboard.petani.pages.transaksi', [
            'title' => 'Petani | Transaksi',
            'notifikasis' => $notifikasis,
            'initials' => $initials,
            'alokasis' => $alokasis,
            'petani' => $petani
        ]);
    }
    public function setCheckoutNonTunai(Request $request): View|RedirectResponse
    {
        $petani = Petani::find(Session::get('id'));
        if(isset($request->all()['id_alokasis']) && isset($request->all()['total_harga'])) {
            $all_request = $request->all();
            ['petani' => $petani, 
            'notifikasis' => $notifikasis, 
            'initials' =>$initials] = $this->dashboard_service->petaniSetSidebar($petani->id);
            ['snap_token' => $snap_token, 
            'alokasis' => $alokasis] = $this->transaksi_service->petaniSetCheckoutNonTunai($all_request['total_harga'], $petani->nama, $all_request['id_alokasis']);
            return view('dashboard.petani.pages.checkout', [
                'title' => 'Petani | Checkout',
                'notifikasis' => $notifikasis,
                'initials' => $initials,
                'alokasis' => $alokasis,
                'id_alokasis' => $all_request['id_alokasis'],
                'snap_token' => $snap_token,
                'total_harga' => $all_request['total_harga']
            ]);
        }
        return back()->withErrors(['db' => 'Pilih Pembayaran Yang Tersedia!']);

    }
    public function checkoutNonTunai(Request $request): RedirectResponse
    {
        $id_alokasis = $request->all()['id_alokasis'];
        if ($this->transaksi_service->petaniCheckoutNonTunai($id_alokasis)) {
            return back()->with('success','Pembayaran Berhasil!');
        }
        return back()->withErrors(['db' => 'Pembayaran Gagal!']);
    }
    public function setRiwayatTransaksi(Request $request): View
    {
        $id = Session::get('id_petani');
        $tahun = intval(date('Y'));
        ['petani' => $petani, 
        'notifikasis' => $notifikasis, 
        'initials' =>$initials] = $this->dashboard_service->petaniSetSidebar($id);
        $tahuns = $this->transaksi_service->petaniSetRiwayatTransaksi($id);
        if(isset($request->tahun) && isset($request->musim_tanam)) {
            $tahun = $request->tahun;
            $riwayat_transaksis = $this->transaksi_service->petaniSetRiwayatTransaksiByTahun($id, $tahun);
        } else {
            $riwayat_transaksis = $this->transaksi_service->petaniSetRiwayatTransaksiByTahun($id, $tahun);
        }
        return view('dashboard.petani.pages.riwayat-transaksi', [
            'title' => 'Petani | Riwayat Transaksi',
            'notifikasis' => $notifikasis,
            'petani' => $petani,
            'initials' => $initials,
            'riwayat_transaksis' => $riwayat_transaksis,
            'tahuns' => $tahuns,
            'tahun' => $tahun,
        ]);
    }
}
