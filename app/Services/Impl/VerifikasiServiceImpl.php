<?php

namespace App\Services\Impl;

use App\Models\KiosResmi;
use App\Models\Petani;
use App\Services\VerifikasiService;
use Illuminate\Support\Facades\DB;

class VerifikasiServiceImpl implements VerifikasiService
{
    public function pemerintahSetVerifikasiPengguna(): array
    {
        $petanis = Petani::select('petanis.*','kelompok_tanis.nama as nama_poktan')
        ->join('kelompok_tanis','petanis.id_kelompok_tani','kelompok_tanis.id','kelompok_tanis.id')
        ->where('aktif',false)->get();
        $kios_resmis = KiosResmi::select('kios_resmis.*','pemilik_kios.*','kecamatans.nama as kecamatan')
            ->join('pemilik_kios','kios_resmis.id_pemilik_kios','pemilik_kios.id')
            ->join('kecamatans','kios_resmis.id_kecamatan','kecamatans.id')
            ->where('aktif',false)->get();
        return ['petanis' => $petanis, 'kios_resmis' => $kios_resmis];
    }
    public function pemerintahVerifikasiPetani($ids): bool
    {
        return DB::transaction(function() use ($ids) {
            return Petani::whereIn('id',$ids)->update(['aktif' => true]);
        });
    }
    public function pemerintahVerifikasiKiosResmi($ids): bool
    {
        return DB::transaction(function() use ($ids) {
            return KiosResmi::whereIn('id',$ids)->update(['aktif' => true]);
        });
    }
}

?>