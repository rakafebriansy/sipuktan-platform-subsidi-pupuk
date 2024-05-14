<?php

namespace App\Services\Impl;

use App\Models\KiosResmi;
use App\Models\Notifikasi;
use App\Models\Pemerintah;
use App\Models\Petani;
use App\Services\DashboardService;

class DashboardServiceImpl implements DashboardService
{    
    public function petaniSetSidebar(int $id): array
    {
        $petani = Petani::select('petanis.*','kelompok_tanis.nama as poktan','kios_resmis.nama as kios_resmi','kios_resmis.jalan as jalan','kecamatans.nama as kecamatan','pemilik_kios.nomor_telepon as notelp_kios')
        ->join('kelompok_tanis','petanis.id_kelompok_tani','kelompok_tanis.id')
        ->join('kios_resmis','kelompok_tanis.id_kios_resmi','kios_resmis.id')
        ->join('pemilik_kios','kios_resmis.id_pemilik_kios','pemilik_kios.id')
        ->join('kecamatans','kecamatans.id','kios_resmis.id_kecamatan')
        ->where('petanis.id',$id)->first();

        $notifikasis = Notifikasi::where('id_petani',$id)->get();

        $nama = explode(" ", $petani->nama);
        $initials = "";

        foreach ($nama as $key => $w) {
            if($key > 1) break;
            $initials .= mb_substr($w, 0, 1);
        }
        return ['petani' => $petani, 'notifikasis' => $notifikasis, 'initials' =>$initials];
    }
    public function kiosResmiSetSidebar(int $id): array
    {
        $kios_resmi = KiosResmi::select('kios_resmis.*','pemilik_kios.nama_pemilik as pemilik', 'pemilik_kios.nomor_telepon','kecamatans.nama as kecamatan')
        ->join('pemilik_kios','kios_resmis.id_pemilik_kios','pemilik_kios.id')
        ->join('kecamatans','kecamatans.id','kios_resmis.id_kecamatan')
        ->where('kios_resmis.id',$id)->first();
        $nama = explode(" ", $kios_resmi->pemilik);
        $initials = "";

        $notifikasis = Notifikasi::where('id_kios_resmi',$id)->get();

        foreach ($nama as $key => $w) {
            if($key > 1) break;
            $initials .= mb_substr($w, 0, 1);
        } 
        return ['kios_resmi' => $kios_resmi, 'notifikasis' => $notifikasis,'initials' =>$initials];
    }
    public function pemerintahSetSidebar(int $id): array
    {
        $pemerintah = Pemerintah::find($id);
        $nama = explode(" ", $pemerintah->nama_pengguna);

        $notifikasis = Notifikasi::where('id_pemerintah',$id)->get();

        $initials = "";

        foreach ($nama as $key => $w) {
            if($key > 1) break;
            $initials .= mb_substr($w, 0, 1);
        } 
        return ['pemerintah' => $pemerintah, 'notifikasis' => $notifikasis,'initials' =>$initials];
    }
}