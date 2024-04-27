<?php

namespace App\Services\Impl;
use App\Models\Alokasi;
use App\Models\Petani;
use App\Models\RiwayatTransaksi;
use App\Services\RiwayatTransaksiService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class RiwayatTransaksiServiceImpl implements RiwayatTransaksiService
{
    public function petaniSetRiwayatTransaksi(int $id_petani): Collection
    {
        $tahuns = Alokasi::distinct()->where('id_petani',$id_petani)->where('status','Dibayar')->orderBy('tahun','desc')->get(['tahun']);
        return $tahuns;
    }
    public function petaniSetRiwayatTransaksiByTahun(int $id_petani, string $tahun): Collection
    {
        $riwayat_transaksis = RiwayatTransaksi::select('riwayat_transaksis.*', 'alokasis.*','jenis_pupuks.jenis as jenis')
        ->selectRaw('alokasis.jumlah_pupuk * jenis_pupuks.harga as total_harga')
        ->join('alokasis','riwayat_transaksis.id_alokasi','alokasis.id')
        ->join('jenis_pupuks','alokasis.id_jenis_pupuk','jenis_pupuks.id')
        ->where('id_petani', $id_petani)
        ->where('alokasis.tahun',$tahun)
        ->orderBy('riwayat_transaksis.tanggal_transaksi')->get();
        return $riwayat_transaksis;
    }
    public function kiosResmiSetRiwayatTransaksi(int $id_kios_resmi): Collection
    {
        $tahuns = Alokasi::distinct()->where('id_kios_resmi',$id_kios_resmi)->where('status','Dibayar')->orderBy('tahun','desc')->get(['tahun']);
        return $tahuns;
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
        ->orderBy('riwayat_transaksis.tanggal_transaksi')->get();
        return $riwayat_transaksis;
    }
}