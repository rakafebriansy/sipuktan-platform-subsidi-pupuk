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
    public function petaniBuatKeluhan(array $keluhan, int $id_petani): bool
    {
        $keluhan['id_petani'] = $id_petani;
        return DB::transaction(function() use($keluhan) {
            return Keluhan::insert($keluhan);
        });
    }
    public function kiosResmiSetKeluhan(int $id_kios_resmi): Collection
    {
        $keluhans = Keluhan::where('id_kios_resmi',$id_kios_resmi)->get();
        return $keluhans;
    }
    public function kiosResmiBuatKeluhan(array $keluhan, int $id_kios_resmi): bool
    {
        $keluhan['id_kios_resmi'] = $id_kios_resmi;
        return DB::transaction(function() use($keluhan) {
            return Keluhan::insert($keluhan);
        });
    }
    public function pemerintahSetKeluhan(int $id_pemerintah): Collection
    {
        $keluhans = Keluhan::all();
        return $keluhans;
    }
    public function pemerintahBalasKeluhan(array $balasan): bool
    {
        return DB::transaction(function() use($balasan) {
            return Keluhan::where('id',$balasan['id'])->update([
                'balasan' => $balasan['balasan'],
                'id_pemerintah' => $balasan['id_pemerintah']
            ]);
        });
    }
    public function ajaxGetKeluhanDetail(int $id): string
    {
        $keluhan = Keluhan::find($id)->toJson(JSON_PRETTY_PRINT);
        return $keluhan;
    }
}

?>