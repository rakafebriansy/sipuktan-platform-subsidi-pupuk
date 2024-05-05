<?php

namespace App\Services\Impl;
use App\Models\Notifikasi;
use App\Services\NotifikasiService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class NotifikasiServiceImpl implements NotifikasiService
{
    public function sendNotifikasi(string $pesan, string $target_aktor, int $id_aktor): int
    {
        $aktor_column = "id_$target_aktor";
        $notifikasi = [
            'isi' => $pesan,
            $aktor_column => $id_aktor
        ];
        $id_notifikasi = DB::transaction(function() use ($notifikasi){
            return Notifikasi::insertGetId($notifikasi);
        });
        return $id_notifikasi;
    }
    public function sendManyNotifikasi(string $pesan, string $target_aktor, array $id_aktors): array
    {
        $notifikasis = [];
        $aktor_column = "id_$target_aktor";
        foreach ($id_aktors as $id_aktor) {
            $notifikasis[] = [
                'isi' => $pesan,
                $aktor_column => $id_aktor
            ];
        }
        $detail_notifikasis = DB::transaction(function() use ($notifikasis){
            $latest_notification_id = DB::table('notifikasis')->select('id')->orderBy('id','DESC')->first();
            if($latest_notification_id == null) $latest_notification_id = 0;
            Notifikasi::insert($notifikasis);
            return DB::table('notifikasis')->select('id','id_petani')->where('id','>',$latest_notification_id)->get()->toArray();
        });
        return $detail_notifikasis;
    }
    public function ajaxDeleteNotifikasi(int $id): bool
    {
        return DB::transaction(function() use ($id) {
            return Notifikasi::where('id',$id)->delete();
        });
    }
}

?>