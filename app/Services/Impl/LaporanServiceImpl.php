<?php

namespace App\Services\Impl;
use App\Models\Alokasi;
use App\Models\Laporan;
use App\Models\MusimTanam;
use App\Models\RiwayatTransaksi;
use App\Services\LaporanService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class LaporanServiceImpl implements LaporanService
{
    public function kiosResmiSetLaporan(int $id_kios_resmi): array
    {
        $tahuns = Alokasi::distinct()->where('id_kios_resmi',$id_kios_resmi)->where('status','Dibayar')->orderBy('tahun','desc')->get(['tahun']);
        $saat_ini = MusimTanam::first();
        return ['saat_ini' => $saat_ini,'tahuns' => $tahuns];
    }
    public function pemerintahSetLaporan(): array
    {
        $tahuns = Alokasi::distinct()->where('status','Dibayar')->orderBy('tahun','desc')->get(['tahun']);
        $saat_ini = MusimTanam::first();
        return ['saat_ini' => $saat_ini,'tahuns' => $tahuns];
    }
    public function kiosResmiSetLaporanByTahun(int $id_kios_resmi, string $tahun, string $musim_tanam): Collection
    {
        $laporans = Laporan::select('laporans.id','laporans.tanggal_pengambilan', 'laporans.status_verifikasi','alokasis.jumlah_pupuk','jenis_pupuks.jenis as jenis','petanis.nama as nama_petani')
        ->join('riwayat_transaksis','riwayat_transaksis.id','laporans.id_riwayat_transaksi')
        ->join('alokasis','riwayat_transaksis.id_alokasi','alokasis.id')
        ->join('jenis_pupuks','alokasis.id_jenis_pupuk','jenis_pupuks.id')
        ->join('petanis','alokasis.id_petani','petanis.id')
        ->selectRaw('alokasis.jumlah_pupuk * jenis_pupuks.harga as total_harga')
        ->where('id_kios_resmi', $id_kios_resmi)
        ->where('alokasis.musim_tanam',$musim_tanam)
        ->where('alokasis.tahun',$tahun)
        ->orderBy('laporans.tanggal_pengambilan', 'desc')->get();
        return $laporans;
    }
    public function kiosResmiLaporan($laporan): bool
    {
        $laporan['foto_bukti_pengambilan']->storePubliclyAs('foto_bukti_pengambilans', $laporan['foto_bukti_pengambilan']->getClientOriginalName(), 'public');
        $laporan['foto_bukti_pengambilan'] = $laporan['foto_bukti_pengambilan']->getClientOriginalName();
        $laporan['foto_ktp']->storePubliclyAs('foto_ktp_laporans', $laporan['foto_ktp']->getClientOriginalName(), 'public');
        $laporan['foto_ktp'] = $laporan['foto_ktp']->getClientOriginalName();
        $laporan['foto_tanda_tangan']->storePubliclyAs('foto_tanda_tangans', $laporan['foto_tanda_tangan']->getClientOriginalName(), 'public');
        $laporan['foto_tanda_tangan'] = $laporan['foto_tanda_tangan']->getClientOriginalName();
        
        if(isset($laporan['foto_surat_kuasa'])) {
            $laporan['foto_surat_kuasa']->storePubliclyAs('foto_surat_kuasas', $laporan['foto_surat_kuasa']->getClientOriginalName(), 'public');
            $laporan['foto_surat_kuasa'] = $laporan['foto_surat_kuasa']->getClientOriginalName();
        }
        
        return DB::transaction(function () use ($laporan) {
            return Laporan::insert($laporan);
        });
    }
    public function kiosResmiUbahLaporan($laporan): bool
    {
        $laporan['foto_bukti_pengambilan']->storePubliclyAs('foto_bukti_pengambilans', $laporan['foto_bukti_pengambilan']->getClientOriginalName(), 'public');
        $laporan['foto_bukti_pengambilan'] = $laporan['foto_bukti_pengambilan']->getClientOriginalName();
        $laporan['foto_ktp']->storePubliclyAs('foto_ktp_laporans', $laporan['foto_ktp']->getClientOriginalName(), 'public');
        $laporan['foto_ktp'] = $laporan['foto_ktp']->getClientOriginalName();
        $laporan['foto_tanda_tangan']->storePubliclyAs('foto_tanda_tangans', $laporan['foto_tanda_tangan']->getClientOriginalName(), 'public');
        $laporan['foto_tanda_tangan'] = $laporan['foto_tanda_tangan']->getClientOriginalName();
        
        if(isset($laporan['foto_surat_kuasa'])) {
            $laporan['foto_surat_kuasa']->storePubliclyAs('foto_surat_kuasas', $laporan['foto_surat_kuasa']->getClientOriginalName(), 'public');
            $laporan['foto_surat_kuasa'] = $laporan['foto_surat_kuasa']->getClientOriginalName();
        } else {
            $laporan['foto_surat_kuasa'] = '';
        }
        
        return DB::transaction(function () use ($laporan) {
            return $laporan = Laporan::where('id',$laporan['id_laporan'])->update([
                'foto_bukti_pengambilan' => $laporan['foto_bukti_pengambilan'],
                'foto_ktp' => $laporan['foto_ktp'],
                'foto_tanda_tangan' => $laporan['foto_tanda_tangan'],
                'foto_surat_kuasa' => $laporan['foto_surat_kuasa'],
                'status_verifikasi' => 'Belum Diverifikasi',
                'telah_diedit' => true,
                'tanggal_diedit' => now(),

            ]);
        });
    }
    public function pemerintahSetLaporanByTahun(string $tahun, string $musim_tanam): Collection
    {
        $laporans = Laporan::select('laporans.id','laporans.status_verifikasi','laporans.tanggal_pengambilan','alokasis.jumlah_pupuk','jenis_pupuks.jenis as jenis','petanis.nama as nama_petani', 'kios_resmis.nama as nama_kios')
        ->join('riwayat_transaksis','riwayat_transaksis.id','laporans.id_riwayat_transaksi')
        ->join('alokasis','riwayat_transaksis.id_alokasi','alokasis.id')
        ->join('jenis_pupuks','alokasis.id_jenis_pupuk','jenis_pupuks.id')
        ->join('kios_resmis','alokasis.id_kios_resmi','kios_resmis.id')
        ->join('petanis','alokasis.id_petani','petanis.id')
        ->where('alokasis.musim_tanam',$musim_tanam)
        ->where('alokasis.tahun',$tahun)
        ->orderBy('laporans.tanggal_pengambilan', 'desc')->get();
        return $laporans;
    }
    public function pemerintahSetujuiLaporan(int $id): bool
    {
        return DB::transaction(function () use ($id) {
            return Laporan::where('id',$id)->update([
                'status_verifikasi' => 'Terverifikasi',
            ]);
        });
    }
    public function pemerintahTolakLaporan(int $id, $catatan): bool
    {
        return DB::transaction(function () use ($id, $catatan) {
            return Laporan::where('id',$id)->update([
                'status_verifikasi' => 'Ditolak',
                'catatan' => $catatan,
                'telah_diedit' => false
            ]);
        });
    }
    public function pemerintahGetIdKiosResmiByLaporan(int $id_laporan): int
    {
        $laporan = DB::table('laporans')->select('alokasis.id_kios_resmi')
        ->join('riwayat_transaksis','riwayat_transaksis.id','laporans.id_riwayat_transaksi')
        ->join('alokasis','alokasis.id','riwayat_transaksis.id_alokasi')
        ->first();
        return $laporan->id_kios_resmi;
    }

    public function ajaxGetPetaniFromRiwayat(string $letters): Collection
    {   
        $riwayat_transaksis = RiwayatTransaksi::select('riwayat_transaksis.*','alokasis.tahun as tahun', 'alokasis.musim_tanam as musim_tanam','jenis_pupuks.jenis as jenis','petanis.nama as nama')
        ->leftJoin('laporans','laporans.id_riwayat_transaksi','riwayat_transaksis.id')
        ->join('alokasis','alokasis.id','riwayat_transaksis.id_alokasi')
        ->join('petanis','petanis.id','alokasis.id_petani')
        ->join('jenis_pupuks','jenis_pupuks.id','alokasis.id_jenis_pupuk')
        ->where('petanis.nama','like',"%$letters%")
        ->whereNull('laporans.id')
        ->limit(5)->get();
        return $riwayat_transaksis;
    }
    public function ajaxGetLaporanFilenames(string $id): string
    {
        $laporan_filenames = Laporan::find($id)->toJson(JSON_PRETTY_PRINT);
        return $laporan_filenames;
    }
}

?>