<?php

namespace App\Services\Impl;

use App\Models\Alokasi;
use App\Models\JenisPupuk;
use App\Models\KelompokTani;
use App\Models\KiosResmi;
use App\Models\PemilikKios;
use App\Models\Petani;
use App\Services\AlokasiService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class AlokasiServiceImpl implements AlokasiService
{    
    public function petaniSetAlokasi(int $id): Collection
    {
        $alokasis = Alokasi::query()->select('alokasis.*','jenis_pupuks.*','kios_resmis.nama as kios_resmi')
        ->join('jenis_pupuks','alokasis.id_jenis_pupuk','jenis_pupuks.id')
        ->join('kios_resmis','alokasis.id_kios_resmi','kios_resmis.id')
        ->where('id_petani', $id)->get();
        
        return $alokasis;
        
    }
    public function kiosResmiSetAlokasiByTahun(int $id, string $tahun, string $musim_tanam): Collection
    {
        $alokasis = Alokasi::select('alokasis.*', 'petanis.nama as petani', 'kelompok_tanis.nama')
        ->join('petanis','petanis.id','alokasis.id_petani')
        ->join('kelompok_tanis','kelompok_tanis.id','petanis.id_kelompok_tani')
        ->where('alokasis.id_kios_resmi',$id)->where('alokasis.tahun',$tahun)->where('alokasis.musim_tanam',$musim_tanam)->get();
        $tahuns = Alokasi::distinct()->orderBy('tahun','desc')->get(['tahun']);
        
        return $alokasis;
    }
    public function kiosResmiSetAlokasi(): Collection
    {
        $tahuns = Alokasi::distinct()->orderBy('tahun','desc')->get(['tahun']);
        
        return $tahuns;
    }
    public function pemerintahSetAlokasi(): array
    {
        $jenis_pupuks = JenisPupuk::all();
        $tahuns = Alokasi::distinct()->orderBy('tahun','desc')->get(['tahun']);
        return ['jenis_pupuks' => $jenis_pupuks, 'tahuns' => $tahuns];
    }
    public function pemerintahGetAlokasiByTahun(string $tahun, string $musim_tanam): Collection
    {
        $alokasis = Alokasi::select('alokasis.*', 'alokasis.id as id_alokasi', 'petanis.*','kelompok_tanis.nama as poktan', 'kios_resmis.nama as kios_resmi', 'jenis_pupuks.*')
        ->join('petanis','petanis.id','alokasis.id_petani')
        ->join('jenis_pupuks','jenis_pupuks.id','alokasis.id_jenis_pupuk')
        ->join('kelompok_tanis','kelompok_tanis.id','petanis.id_kelompok_tani')
        ->join('kios_resmis','alokasis.id_kios_resmi','kios_resmis.id')
        ->where('alokasis.tahun',$tahun)->where('alokasis.musim_tanam',$musim_tanam)->get();

        return $alokasis;
    }
    public function pemerintahTambahAlokasi(array $alokasi): void
    {
        $petani = Petani::query()->where('nik',$alokasi['nik'])->first();
        $kelompok_tani = KelompokTani::find($petani->id_kelompok_tani);
        $kios_resmi = $kelompok_tani->kios_resmi;
        DB::transaction(function() use ($alokasi, $petani, $kios_resmi){
            Alokasi::create([
                'jumlah_pupuk' => $alokasi['jumlah_pupuk'],
                'tahun' => $alokasi['tahun'],
                'musim_tanam' => $alokasi['musim_tanam'],
                'id_jenis_pupuk' => $alokasi['id_jenis_pupuk'],
                'id_petani' => $petani->id,
                'id_kios_resmi' => $kios_resmi->id,
            ]);
        });
    }
    public function pemerintahHapusAlokasi(int $id): void
    {
        DB::transaction(function () use ($id) {
            Alokasi::query()->where('id',$id)->delete();
        });
    }
    
}