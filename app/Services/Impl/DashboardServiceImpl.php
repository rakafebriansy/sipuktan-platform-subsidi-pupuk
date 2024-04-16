<?php

namespace App\Services\Impl;

use App\Models\KelompokTani;
use App\Models\KiosResmi;
use App\Models\PemilikKios;
use App\Models\Petani;
use App\Services\AkunService;
use App\Services\DashboardService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class DashboardServiceImpl implements DashboardService
{    
    public function petaniSetDashboard(int $id): array
    {
        $petani = Petani::select('petanis.*','kelompok_tanis.nama as poktan','kios_resmis.nama as kios_resmi','kios_resmis.jalan as jalan','kecamatans.nama as kecamatan')
        ->join('kelompok_tanis','petanis.id_kelompok_tani','kelompok_tanis.id')
        ->join('kios_resmis','kelompok_tanis.id_kios_resmi','kios_resmis.id')
        ->join('kecamatans','kecamatans.id','kios_resmis.id_kecamatan')
        ->where('petanis.id',$id)->first();
        $nama = explode(" ", $petani->nama);
        $initials = "";

        foreach ($nama as $w) {
            $initials .= mb_substr($w, 0, 1);
        } 
        return ['petani' => $petani,'initials' =>$initials];
        
    }
    public function kiosResmiSetDashboard(int $id): array
    {
        $kios_resmi = KiosResmi::select('kios_resmis.*','pemilik_kios.nama_pemilik as pemilik', 'pemilik_kios.nomor_telepon','kecamatans.nama as kecamatan')
        ->join('pemilik_kios','kios_resmis.id_pemilik_kios','pemilik_kios.id')
        ->join('kecamatans','kecamatans.id','kios_resmis.id_kecamatan')
        ->where('kios_resmis.id',$id)->first();
        $nama = explode(" ", $kios_resmi->nama);
        $initials = "";

        foreach ($nama as $w) {
            $initials .= mb_substr($w, 0, 1);
        } 
        return ['kios_resmi' => $kios_resmi,'initials' =>$initials];
    }
}