<?php

namespace App\Services\Impl;

use App\Models\KelompokTani;
use App\Models\KiosResmi;
use App\Models\PemilikKios;
use App\Models\Petani;
use App\Services\AkunService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AkunServiceImpl implements AkunService
{    
    public function petaniRegister(array $data_petani, array|UploadedFile $foto_ktp): void
    {
        $foto_ktp->storePubliclyAs('foto_ktps', $foto_ktp->getClientOriginalName(), 'public');
        $data_petani['foto_ktp'] = $foto_ktp->getClientOriginalName(); 
        $data_petani['kata_sandi'] = Hash::make($data_petani['kata_sandi']);
        DB::transaction(function () use ($data_petani) {
            Petani::insert($data_petani);
        });
    }
    public function kiosResmiRegister(array $data_kios, array|UploadedFile $foto_ktp): void
    {
        $foto_ktp->storePubliclyAs('foto_ktps', $foto_ktp->getClientOriginalName(), 'public');
        $data_kios['foto_ktp'] = $foto_ktp->getClientOriginalName();
        $data_kios['kata_sandi'] = Hash::make($data_kios['kata_sandi']);
        DB::transaction(function () use ($data_kios) {
            $id_pemilik_kios = PemilikKios::insertGetId([
                'nama_pemilik' => $data_kios['nama_pemilik'],
                'nik' => $data_kios['nik'],
                'nomor_telepon' => $data_kios['nomor_telepon'],
                'foto_ktp' => $data_kios['foto_ktp'],
            ]);
            KiosResmi::insert([
                'nib' => $data_kios['nib'],
                'nama'=> $data_kios['nama'],
                'kata_sandi' => $data_kios['kata_sandi'],
                'jalan'=> $data_kios['jalan'],
                'id_kecamatan' => $data_kios['id_kecamatan'],
                'id_pemilik_kios' => $id_pemilik_kios,
            ]);
        }); 
    }
    public function petaniGantiSandi(int $id, array $sandi_petani): bool
    {
        $petani = Petani::find($id);
        if($petani->kata_sandi == $sandi_petani['sandi_lama']) {
            return false;
        } else {
            $sandi_baru = Hash::make($sandi_petani['sandi_baru']);
            Petani::query()->where('id',$id)->update(['kata_sandi' => $sandi_baru]);
            return true;
        }
    }
    public function kiosResmiGantiSandi(int $id, array $sandi_kios): bool
    {
        $kios_resmi = KiosResmi::find($id);
        if($kios_resmi->kata_sandi == $sandi_kios['sandi_lama']) {
            return false;
        } else {
            $sandi_baru = Hash::make($sandi_kios['sandi_baru']);
            KiosResmi::query()->where('id',$id)->update(['kata_sandi' => $sandi_baru]);
            return true;
        }
    }
}