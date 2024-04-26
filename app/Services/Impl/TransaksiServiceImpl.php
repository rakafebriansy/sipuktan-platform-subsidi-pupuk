<?php

namespace App\Services\Impl;

use App\Models\Alokasi;
use App\Models\JenisPupuk;
use App\Models\KelompokTani;
use App\Models\KiosResmi;
use App\Models\PemilikKios;
use App\Models\Petani;
use App\Models\RiwayatTransaksi;
use App\Services\AlokasiService;
use App\Services\TransaksiService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TransaksiServiceImpl implements TransaksiService
{
    public function petaniSetTransaksi(int $id): Collection
    {
        $alokasis = Alokasi::query()->select('alokasis.*','jenis_pupuks.jenis as jenis','kios_resmis.nama as kios_resmi')
        ->selectRaw('alokasis.jumlah_pupuk * jenis_pupuks.harga as total_harga')
        ->join('jenis_pupuks','alokasis.id_jenis_pupuk','jenis_pupuks.id')
        ->join('kios_resmis','alokasis.id_kios_resmi','kios_resmis.id')
        ->where('id_petani', $id)->where('alokasis.status','Menunggu Pembayaran')->orderBy('jenis_pupuks.jenis')->get();
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
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

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
    public function petaniCheckoutNonTunai(array $id_alokasis): bool
    {
        DB::transaction(function () use ($id_alokasis) {
            $riwayat_transaksis = [];
            foreach($id_alokasis as $id_alokasi) {
                $riwayat_transaksis[] = [
                    'metode_pembayaran' => 'Non-Tunai',
                    'id_alokasi' => $id_alokasi
                ];
            }

            RiwayatTransaksi::insert($riwayat_transaksis);
            Alokasi::whereIn('id',$id_alokasis)->update(['status' => 'Dibayar']);
        });
        return true;
    }
}