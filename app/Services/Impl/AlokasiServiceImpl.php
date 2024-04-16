<?php

namespace App\Services\Impl;

use App\Models\Alokasi;
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
    public function pemerintahSetAlokasiByTahun(string $tahun): Collection
    {
        $alokasis = Alokasi::select('alokasis.*', 'petanis.nama as petani', 'kelompok_tanis.nama')
        ->join('petanis','petanis.id','alokasis.id_petani')
        ->join('kelompok_tanis','kelompok_tanis.id','petanis.id_kelompok_tani')
        ->where('alokasis.tahun',$tahun)->get();
        
        return $alokasis;
    }
}