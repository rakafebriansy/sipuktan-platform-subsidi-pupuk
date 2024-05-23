<?php

namespace App\Services\Impl;

use App\Models\KelompokTani;
use App\Models\KiosResmi;
use App\Services\CrudService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class CrudServiceImpl implements CrudService
{
    public function pemerintahSetKelompokTani(): Collection
    {
        $kelompok_tanis = KelompokTani::select('kelompok_tanis.*','kios_resmis.nama as kios_resmi','kecamatans.nama as kecamatan')
        ->join('kios_resmis','kelompok_tanis.id_kios_resmi','kios_resmis.id')
        ->join('kecamatans','kecamatans.id','kios_resmis.id_kecamatan')
        ->orderBy('kelompok_tanis.nama')
        ->get();
        return $kelompok_tanis;
    }
    public function pemerintahBuatKelompokTani(array $data): bool
    {
        return DB::transaction(function() use($data) {
            return KelompokTani::insert($data);
        });
    }
    public function pemerintahEditKelompokTani(array $data): bool
    {
        return DB::transaction(function() use($data) {
            return KelompokTani::where('id',$data['id'])->update([
                'nama' => $data['nama'],
                'id_kios_resmi' => $data['id_kios_resmi']
            ]);
        });
    }
    public function pemerintahHapusKelompokTani(int $id): bool
    {
        return DB::transaction(function() use($id) {
            return KelompokTani::where('id',$id)->delete();
        });
    }
    public function ajaxGetKios(string $letters): string
    {   
        $letters = strtolower($letters);
        $riwayat_transaksis = KiosResmi::where('nama','like',"%$letters%")->limit(5)->get()->toJson(JSON_PRETTY_PRINT);
        return $riwayat_transaksis;
    }
    public function ajaxGetPoktan(int $id): string
    {   
        $riwayat_transaksis = KelompokTani::select('kelompok_tanis.*','kios_resmis.id as id_kios_resmi','kios_resmis.nama as kios_resmi')
        ->join('kios_resmis','kelompok_tanis.id_kios_resmi','kios_resmis.id')
        ->where('kelompok_tanis.id',$id)->first()->toJson(JSON_PRETTY_PRINT);
        return $riwayat_transaksis;
    }
}

?>