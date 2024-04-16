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
    public function kiosResmiSetAlokasiByTahun(int $id, string $tahun): Collection
    {
        $alokasis = Alokasi::select('alokasis.*', 'petanis.nama as petani', 'kelompok_tanis.nama')
        ->join('petanis','petanis.id','alokasis.id_petani')
        ->join('kelompok_tanis','kelompok_tanis.id','petanis.id_kelompok_tani')
        ->where('alokasis.id_kios_resmi',$id)->where('alokasis.tahun',$tahun)->get();
        
        return $alokasis;
    }
    public function pemerintahSetAlokasiByTahun(string $tahun): array
    {
        $alokasis = Alokasi::select('alokasis.*', 'petanis.nama as petani', 'kelompok_tanis.nama')
        ->join('petanis','petanis.id','alokasis.id_petani')
        ->join('kelompok_tanis','kelompok_tanis.id','petanis.id_kelompok_tani')
        ->where('alokasis.tahun',$tahun)->get();
        $jenis_pupuks = JenisPupuk::all();
        return ['alokasis' => $alokasis, 'jenis_pupuks' => $jenis_pupuks];
    }
    public function pemerintahAlokasi(array $alokasi): void
    {
        $petani = Petani::query()->where('nik',$alokasi['nik'])->first();
        $kelompok_tani = KelompokTani::find($petani->id_kelompok_tani);
        $kios_resmi = $kelompok_tani->kios_resmi;
        Alokasi::create([
            'jumlah_pupuk' => $alokasi['jumlah_pupuk'],
            'tahun' => $alokasi['tahun'],
            'musim_tanam' => $alokasi['musim_tanam'],
            'id_jenis_pupuk' => $alokasi['id_jenis_pupuk'],
            'id_petani' => $petani->id,
            'id_kios_resmi' => $kios_resmi->id,
        ]);
    }
    public function getAlokasiTahun(): Collection
    {
        $tahuns = Alokasi::distinct()->orderBy('tahun','desc')->get(['tahun']);
        return $tahuns;
    }
    
}