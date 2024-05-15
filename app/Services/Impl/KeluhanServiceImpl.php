<?php

namespace App\Services\Impl;
use App\Models\Keluhan;
use App\Models\Petani;
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
    public function petaniBuatKeluhan(array $keluhan, int $id_petani): int|null
    {
        $keluhan['id_petani'] = $id_petani;
        return DB::transaction(function() use($keluhan) {
            $keluhan = Keluhan::create($keluhan);
            return $keluhan->id;
        });
    }
    public function kiosResmiSetKeluhan(int $id_kios_resmi): Collection
    {
        $keluhans = Keluhan::where('id_kios_resmi',$id_kios_resmi)->get();
        return $keluhans;
    }
    public function kiosResmiBuatKeluhan(array $keluhan, int $id_kios_resmi): int|null
    {
        $keluhan['id_kios_resmi'] = $id_kios_resmi;
        return DB::transaction(function() use($keluhan) {
            $keluhan = Keluhan::create($keluhan);
            return $keluhan->id;
        });
    }
    public function pemerintahSetKeluhan(int $id_pemerintah): Collection
    {
        $keluhans = Keluhan::all();
        $petani = Petani::find($keluhans[0]->id_petani);
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
    public function ajaxGetKeluhanBlade(int $id): string
    {
        $keluhan = Keluhan::find($id);
        $xmlString = [
            'row' => view('dashboard.pemerintah.elements.keluhan-row',[
                'keluhan' => $keluhan
            ])->render(),
            'backdropModal' => view('dashboard.pemerintah.elements.laporan-backdropmodal')->render(),
            ];
        return json_encode($xmlString,JSON_PRETTY_PRINT);
    }
}

?>