<?php

namespace App\Services\Impl;
use App\Models\Alokasi;
use App\Models\Laporan;
use App\Models\Petani;
use App\Models\RiwayatTransaksi;
use App\Services\LaporanService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

class LaporanServiceImpl implements LaporanService
{
    public function kiosResmiSetLaporan(int $id_kios_resmi): Collection
    {
        $tahuns = Alokasi::distinct()->where('id_kios_resmi',$id_kios_resmi)->where('status','Dibayar')->orderBy('tahun','desc')->get(['tahun']);
        return $tahuns;
    }
    public function kiosResmiSetLaporanByTahun(int $id_kios_resmi, string $tahun, string $musim_tanam): Collection
    {
        $riwayat_transaksis = RiwayatTransaksi::select('riwayat_transaksis.*','alokasis.jumlah_pupuk','jenis_pupuks.jenis as jenis','petanis.nama as nama_petani')
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
    public function kiosResmiLaporan($laporan): bool
    {
        $laporan['foto_bukti_pengambilan']->storePubliclyAs('foto_bukti_pengambilans', $laporan['foto_bukti_pengambilan']->getClientOriginalName(), 'public');
        $laporan['foto_bukti_pengambilan'] = $laporan['foto_bukti_pengambilan']->getClientOriginalName();
        $laporan['foto_ktp']->storePubliclyAs('foto_ktps', $laporan['foto_ktp']->getClientOriginalName(), 'public');
        $laporan['foto_ktp'] = $laporan['foto_ktp']->getClientOriginalName();
        $laporan['foto_surat_kuasa']->storePubliclyAs('foto_surat_kuasas', $laporan['foto_surat_kuasa']->getClientOriginalName(), 'public');
        $laporan['foto_surat_kuasa'] = $laporan['foto_surat_kuasa']->getClientOriginalName();
        $laporan['foto_tanda_tangan']->storePubliclyAs('foto_tanda_tangans', $laporan['foto_tanda_tangan']->getClientOriginalName(), 'public');
        $laporan['foto_tanda_tangan'] = $laporan['foto_tanda_tangan']->getClientOriginalName();
        
        DB::transaction(function () use ($laporan) {
            Laporan::insert($laporan);
        });
        return true;
    }
}

?>