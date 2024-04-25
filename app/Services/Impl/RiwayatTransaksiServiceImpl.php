<?php

namespace App\Services\Impl;
use App\Models\Alokasi;
use App\Models\Petani;
use App\Services\RiwayatTransaksiService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class RiwayatTransaksiServiceImpl implements RiwayatTransaksiService
{
    public function petaniSetRiwayatTransaksi(int $id_petani): Collection
    {
        $tahuns = Alokasi::distinct()->where('id_petani',$id_petani)->orderBy('tahun','desc')->get(['tahun']);
        return $tahuns;
    }
    public function petaniSetRiwayatTransaksiByTahun(int $id_petani, int $tahun): Collection
    {
        $riwayat_transaksis = Alokasi::select('alokasis.*','riwayat_transaksis.*','jenis_pupuks.jenis as jenis')
        ->selectRaw('alokasis.jumlah_pupuk * jenis_pupuks.harga as total_harga')
        ->join('riwayat_transaksis','alokasis.id','riwayat_transaksis.id_alokasi')
        ->join('jenis_pupuks','alokasis.id_jenis_pupuk','jenis_pupuks.id')
        ->where('id_petani', $id_petani)
        ->where('alokasis.status','Dibayar')
        ->where('alokasis.tahun',$tahun)
        ->orderBy('riwayat_transaksis.tanggal_transaksi')->get();
        return $riwayat_transaksis;
    }
}