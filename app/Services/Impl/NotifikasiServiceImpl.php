<?php

namespace App\Services\Impl;
use App\Models\Notifikasi;
use App\Services\NotifikasiService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class NotifikasiServiceImpl implements NotifikasiService
{
    public function sendManyNotifikasi(string $pesan, string $target_aktor, array $id_aktors): bool
    {
        $notifikasis = [];
        $aktor_column = "id_$target_aktor";
        foreach ($id_aktors as $id_aktor) {
            $notifikasis[] = [
                'isi' => $pesan,
                $aktor_column => $id_aktor
            ];
        }
        DB::transaction(function() use ($notifikasis){
            Notifikasi::insert($notifikasis);
        });
        return true;
    }
    public function ajaxDeleteNotifikasi(int $id): bool
    {
        DB::transaction(function() use ($id) {
            Notifikasi::where('id',$id)->delete();
        });
        return true;
    }
}

?>