<?php

namespace App\Services\Impl;

use App\Models\Alokasi;
use App\Models\MusimTanam;
use App\Models\RiwayatTransaksi;
use App\Services\TransaksiService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TransaksiServiceImpl implements TransaksiService
{
    public function petaniSetTransaksi(int $id_petani): Collection
    {
        $alokasis = Alokasi::query()->select('alokasis.*','jenis_pupuks.jenis as jenis','kios_resmis.nama as kios_resmi')
        ->selectRaw('alokasis.jumlah_pupuk * jenis_pupuks.harga as total_harga')
        ->join('jenis_pupuks','alokasis.id_jenis_pupuk','jenis_pupuks.id')
        ->join('kios_resmis','alokasis.id_kios_resmi','kios_resmis.id')
        ->where('id_petani', $id_petani)->where('alokasis.status','Menunggu Pembayaran')->orderBy('jenis_pupuks.jenis')->get();
        return $alokasis;
    }
    public function kiosResmiSetTransaksi(int $id_kios_resmi): Collection
    {
        $alokasis = Alokasi::query()->select('alokasis.*','jenis_pupuks.jenis as jenis','petanis.nama as nama_petani')
        ->selectRaw('alokasis.jumlah_pupuk * jenis_pupuks.harga as total_harga')
        ->join('jenis_pupuks','alokasis.id_jenis_pupuk','jenis_pupuks.id')
        ->join('petanis','alokasis.id_petani','petanis.id')
        ->where('id_kios_resmi', $id_kios_resmi)->where('alokasis.status','Menunggu Pembayaran')->orderBy('petanis.nama')->get();
        return $alokasis;
    }
    public function petaniSetCheckoutNonTunai(int $total_harga, string $nama, array $id_alokasis): array
    {
        $nama_awal = explode(' ', $nama)[0];

        $alokasis = Alokasi::query()->select('alokasis.*','jenis_pupuks.jenis as jenis')
        ->selectRaw('alokasis.jumlah_pupuk * jenis_pupuks.harga as total_harga')
        ->join('jenis_pupuks','alokasis.id_jenis_pupuk','jenis_pupuks.id')
        ->whereIn('alokasis.id',$id_alokasis)->get();

        //MIDTRANS API START
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is3ds');

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $total_harga,
            ),
            'customer_details' => array(
                'first_name' => $nama_awal
            )
        );

        $snap_token = \Midtrans\Snap::getSnapToken($params);
        //MIDTRANS API END

        return ['snap_token' => $snap_token, 'alokasis' => $alokasis];
    }
    public function kiosResmiTransaksi(array $id_alokasis): bool
    {
        DB::transaction(function () use ($id_alokasis) {
            $riwayat_transaksis = [];
            foreach($id_alokasis as $id_alokasi) {
                $riwayat_transaksis[] = [
                    'metode_pembayaran' => 'Tunai',
                    'id_alokasi' => $id_alokasi
                ];
            }
            RiwayatTransaksi::insert($riwayat_transaksis);
            Alokasi::whereIn('id',$id_alokasis)->update(['status' => 'Dibayar']);
        });
        return true;
    }
    public function petaniCheckoutNonTunai(array $id_alokasis): bool
    {
        return DB::transaction(function () use ($id_alokasis) {
            $riwayat_transaksis = [];
            foreach($id_alokasis as $id_alokasi) {
                $riwayat_transaksis[] = [
                    'metode_pembayaran' => 'Non-Tunai',
                    'id_alokasi' => $id_alokasi
                ];
            }

            RiwayatTransaksi::insert($riwayat_transaksis);
            return Alokasi::whereIn('id',$id_alokasis)->update(['status' => 'Dibayar']);
        });
    }
    public function petaniSetRiwayatTransaksi(int $id_petani): array
    {
        $tahuns = Alokasi::distinct()->where('id_petani',$id_petani)->where('status','Dibayar')->orderBy('tahun','desc')->get(['tahun']);
        $saat_ini = MusimTanam::first();
        return ['saat_ini' => $saat_ini,'tahuns' => $tahuns];
    }
    public function petaniSetRiwayatTransaksiByTahun(int $id_petani, string $tahun): Collection
    {
        $riwayat_transaksis = RiwayatTransaksi::select('riwayat_transaksis.*', 'alokasis.*','jenis_pupuks.jenis as jenis')
        ->selectRaw('alokasis.jumlah_pupuk * jenis_pupuks.harga as total_harga')
        ->join('alokasis','riwayat_transaksis.id_alokasi','alokasis.id')
        ->join('jenis_pupuks','alokasis.id_jenis_pupuk','jenis_pupuks.id')
        ->where('id_petani', $id_petani)
        ->where('alokasis.tahun',$tahun)
        ->orderBy('riwayat_transaksis.tanggal_transaksi', 'desc')->get();
        return $riwayat_transaksis;
    }
    public function kiosResmiSetRiwayatTransaksi(int $id_kios_resmi): array
    {
        $tahuns = Alokasi::distinct()->where('id_kios_resmi',$id_kios_resmi)->where('status','Dibayar')->orderBy('tahun','desc')->get(['tahun']);
        $saat_ini = MusimTanam::first();
        return ['saat_ini' => $saat_ini,'tahuns' => $tahuns];
    }
    public function kiosResmiSetRiwayatTransaksiByTahun(int $id_kios_resmi, string $tahun, string $musim_tanam): Collection
    {
        $riwayat_transaksis = RiwayatTransaksi::select('riwayat_transaksis.*','alokasis.*','jenis_pupuks.jenis as jenis','petanis.nama as nama_petani')
        ->selectRaw('alokasis.jumlah_pupuk * jenis_pupuks.harga as total_harga')
        ->join('alokasis','riwayat_transaksis.id_alokasi','alokasis.id')
        ->join('jenis_pupuks','alokasis.id_jenis_pupuk','jenis_pupuks.id')
        ->join('petanis','alokasis.id_petani','petanis.id')
        ->where('id_kios_resmi', $id_kios_resmi)
        ->where('alokasis.musim_tanam',$musim_tanam)
        ->where('alokasis.tahun',$tahun)
        ->orderBy('riwayat_transaksis.tanggal_transaksi', 'desc')->get();
        return $riwayat_transaksis;
    }
}