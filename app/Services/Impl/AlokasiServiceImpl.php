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
        DB::transaction(function () use ($tahun, $musim_tanam) {
            Alokasi::where('tahun',$tahun)->where('musim_tanam',$musim_tanam)->where('status','Belum Tersedia')->update([
                'status' => 'Menunggu Pembayaran'
            ]);
        });
        return true;
    }
    public function kiosResmiSetAlokasiByTahun(int $id, string $tahun, string $musim_tanam): Collection
    {
        $alokasis = Alokasi::select('alokasis.*', 'petanis.nama as petani', 'petanis.nomor_telepon as nomor_telepon', 'kelompok_tanis.nama as poktan')
        ->join('petanis','petanis.id','alokasis.id_petani')
        ->join('kelompok_tanis','kelompok_tanis.id','petanis.id_kelompok_tani')
        ->where('alokasis.id_kios_resmi',$id)->where('alokasis.tahun',$tahun)->where('alokasis.musim_tanam',$musim_tanam)->orderBy('petanis.nama')->get();
        
        return $alokasis;
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
    public function pemerintahTambahAlokasi(array $alokasi): bool
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
        return true;
    }
    public function pemerintahHapusAlokasi(int $id): bool
    {
        DB::transaction(function () use ($id) {
            Alokasi::query()->where('id',$id)->delete();
        });
        return true;

    }
    public function pemerintahEditAlokasi(array $alokasi): bool
    {
        $petani = Petani::query()->where('nik',$alokasi['nik'])->first();
        $kelompok_tani = $petani->kelompok_tani;
        $kios_resmi = $kelompok_tani->kios_resmi;
        Alokasi::query()->where('id',$alokasi['id'])->update([
            'id_petani' => $petani->id,
            'jumlah_pupuk' => $alokasi['jumlah_pupuk'],
            'tahun' => $alokasi['tahun'],
            'id_jenis_pupuk' => $alokasi['id_jenis_pupuk'],
            'musim_tanam' => $alokasi['musim_tanam'],
            'id_kios_resmi' => $kios_resmi->id
        ]);
        return true;
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