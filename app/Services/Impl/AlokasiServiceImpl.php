<?php

namespace App\Services\Impl;

use App\Models\Alokasi;
use App\Models\JenisPupuk;
use App\Models\KelompokTani;
use App\Models\Petani;
use App\Services\AlokasiService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class AlokasiServiceImpl implements AlokasiService
{    
    public function petaniSetAlokasi(int $id): Collection
    {
        $alokasis = Alokasi::select('alokasis.*','jenis_pupuks.*','kios_resmis.nama as kios_resmi')
        ->join('jenis_pupuks','alokasis.id_jenis_pupuk','jenis_pupuks.id')
        ->join('kios_resmis','alokasis.id_kios_resmi','kios_resmis.id')
        ->where('id_petani', $id)->orderBy('jenis_pupuks.jenis')->get();
        return $alokasis;
    }
    public function kiosResmiSetAlokasi(): Collection
    {
        $tahuns = Alokasi::distinct()->orderBy('tahun','desc')->get(['tahun']);
        
        return $tahuns;
    }
    public function kiosResmiAlokasi(string $tahun, string $musim_tanam): bool
    {
        return DB::transaction(function () use ($tahun, $musim_tanam) {
            return Alokasi::where('tahun',$tahun)->where('musim_tanam',$musim_tanam)->where('status','Belum Tersedia')->update([
                'status' => 'Menunggu Pembayaran'
            ]);
        });
    }
    public function kiosResmiSetAlokasiByTahun(int $id, string $tahun, string $musim_tanam): Collection
    {
        $alokasis = Alokasi::select('alokasis.*', 'petanis.nama as petani', 'petanis.nomor_telepon as nomor_telepon', 'kelompok_tanis.nama as poktan')
        ->join('petanis','petanis.id','alokasis.id_petani')
        ->join('kelompok_tanis','kelompok_tanis.id','petanis.id_kelompok_tani')
        ->where('alokasis.id_kios_resmi',$id)->where('alokasis.tahun',$tahun)->where('alokasis.musim_tanam',$musim_tanam)->orderBy('petanis.nama')->get();
        
        return $alokasis;
    }
    public function kiosResmiGetDistinctIdPetaniByTahunMusimTanam(string $tahun, string $musim_tanam): array
    {
        $id_petanis = Alokasi::where('tahun',$tahun)->where('musim_tanam',$musim_tanam)->distinct()->pluck('id_petani')->toArray();
        return $id_petanis;
    }
    public function pemerintahSetAlokasi(): array
    {
        $jenis_pupuks = JenisPupuk::all();
        $tahuns = Alokasi::distinct()->orderBy('tahun','desc')->get(['tahun']);
        return ['jenis_pupuks' => $jenis_pupuks, 'tahuns' => $tahuns];
    }
    public function pemerintahSetAlokasiByTahun(string $tahun, string $musim_tanam): Collection
    {
        $alokasis = Alokasi::select('alokasis.*', 'alokasis.id as id_alokasi', 'petanis.*','kelompok_tanis.nama as poktan', 'jenis_pupuks.*', 'kios_resmis.id as id_kios_resmi', 'kios_resmis.nama as kios_resmi')
        ->join('petanis','petanis.id','alokasis.id_petani')
        ->join('jenis_pupuks','jenis_pupuks.id','alokasis.id_jenis_pupuk')
        ->join('kelompok_tanis','kelompok_tanis.id','petanis.id_kelompok_tani')
        ->join('kios_resmis','kios_resmis.id','kelompok_tanis.id_kios_resmi')
        ->where('alokasis.tahun',$tahun)->where('alokasis.musim_tanam',$musim_tanam)->orderBy('petanis.nama')->get();

        return $alokasis;
    }
    public function pemerintahBuatAlokasi(array $alokasi): bool
    {
        $petani = Petani::where('nik',$alokasi['nik'])->first();
        $kelompok_tani = KelompokTani::find($petani->id_kelompok_tani);
        $kios_resmi = $kelompok_tani->kios_resmi;
        return DB::transaction(function() use ($alokasi, $petani, $kios_resmi){
            return Alokasi::create([
                'jumlah_pupuk' => $alokasi['jumlah_pupuk'],
                'tahun' => $alokasi['tahun'],
                'musim_tanam' => $alokasi['musim_tanam'],
                'id_jenis_pupuk' => $alokasi['id_jenis_pupuk'],
                'id_petani' => $petani->id,
                'id_kios_resmi' => $kios_resmi->id,
            ]);
        });
    }
    public function pemerintahHapusAlokasi(int $id): bool
    {
        return DB::transaction(function () use ($id) {
            return Alokasi::where('id',$id)->delete();
        });
    }
    public function pemerintahEditAlokasi(array $alokasi): bool
    {
        return DB::transaction(function() use($alokasi) {
            return Alokasi::where('id',$alokasi['id'])->update([
                'jumlah_pupuk' => $alokasi['jumlah_pupuk'],
                'tahun' => $alokasi['tahun'],
                'id_jenis_pupuk' => $alokasi['id_jenis_pupuk'],
                'musim_tanam' => $alokasi['musim_tanam'],
            ]);
        });
    }
    public function ajaxDetailAlokasiPetani(int $id): string
    {
        $detail_petani = Alokasi::select('petanis.nomor_telepon', 'kelompok_tanis.nama as poktan')
        ->join('petanis','alokasis.id_petani','petanis.id')
        ->join('kelompok_tanis','kelompok_tanis.id','petanis.id_kelompok_tani')
        ->where('alokasis.id',$id)
        ->first();
        return $detail_petani;
    }
    
}