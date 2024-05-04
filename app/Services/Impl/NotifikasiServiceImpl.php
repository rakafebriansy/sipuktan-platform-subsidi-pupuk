<?php

namespace App\Services\Impl;
use App\Models\Notifikasi;
use App\Services\NotifikasiService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class NotifikasiServiceImpl implements NotifikasiService
{
    public function sendManyNotifikasi(string $pesan, string $target_aktor, Collection $aktors): bool
    {
        $notifikasis = [];
        $aktor_column = "id_$target_aktor";
        foreach ($aktors as $aktor) {
            $notifikasis[] = [
                'isi' => $pesan,
                $aktor_column => $aktor->$aktor_column
            ];
        }
        DB::transaction(function() use ($notifikasis){
            Notifikasi::insert($notifikasis);
        });
        return true;
    }
}

?>