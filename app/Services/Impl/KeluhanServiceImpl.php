<?php

namespace App\Services\Impl;
use App\Models\Keluhan;
use App\Services\KeluhanService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class KeluhanServiceImpl implements KeluhanService
{
    public function petaniSetKeluhan(int $id_petani): Collection
    {
        $keluhans = Keluhan::where('id_petani',$id_petani)->get();
        return $keluhans;
    }
    public function petaniKeluhan(string $keluhan, int $id_petani): bool
    {
        return DB::transaction(function() use($keluhan, $id_petani) {
            return Keluhan::insert([
                'keluhan' => $keluhan,
                'id_petani' => $id_petani
            ]);
        });
    }
    public function kiosResmiSetKeluhan(int $kios_resmi): Collection
    {
        $keluhans = Keluhan::where('id_kios_resmi',$kios_resmi)->get();
        return $keluhans;
    }
    public function kiosResmiKeluhan(string $keluhan, int $id_kios_resmi): bool
    {
        return DB::transaction(function() use($keluhan, $id_kios_resmi) {
            return Keluhan::insert([
                'keluhan' => $keluhan,
                'id_kios_resmi' => $id_kios_resmi
            ]);
        });
    }
    public function pemerintahSetKeluhan(int $id_pemerintah): Collection
    {
        $keluhans = Keluhan::where('id_pemerintah',$id_pemerintah)->get();
        return $keluhans;
    }
    public function pemerintahBalasKeluhan(string $balasan, int $id_keluhan): bool
    {
        return DB::transaction(function() use($balasan, $id_keluhan) {
            return Keluhan::where('id',$id_keluhan)->update([
                'balasan' => $balasan
            ]);
        });
    }
}

?>