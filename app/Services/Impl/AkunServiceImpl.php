<?php

namespace App\Services\Impl;

use App\Models\KiosResmi;
use App\Models\Pemerintah;
use App\Models\PemilikKios;
use App\Models\Petani;
use App\Services\AkunService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AkunServiceImpl implements AkunService
{    
    public function petaniLogin(string $nik, string $kata_sandi): object|null
    {
        $petani = Petani::where('nik',$nik)->first();
        if(isset($petani)) {
            if(Hash::check($kata_sandi,$petani->kata_sandi)){
                return $petani;
            }
        }
        return null;
    }
    public function kiosResmiLogin(string $nib, string $kata_sandi): object|null
    {
        $kios_resmi = KiosResmi::where('nib',$nib)->first();
        if(isset($kios_resmi)) {
            if(Hash::check($kata_sandi,$kios_resmi->kata_sandi)){
                return $kios_resmi;
            }
        }
        return null;
    }
    public function pemerintahLogin(string $nama_pengguna, string $kata_sandi): object|null
    {
        $pemerintah = Pemerintah::where('nama_pengguna',$nama_pengguna)->first();
        if(isset($pemerintah)) {
            if(Hash::check($kata_sandi,$pemerintah->kata_sandi)){
                return $pemerintah;
            }
        }
        return null;
    }
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
    public function petaniCekSandi(int $id, string $sandi_lama): bool
    {
        $kios_resmi = Petani::find($id);
        if(Hash::check($sandi_lama,$kios_resmi->kata_sandi)) return true;
        return false;
    }
    public function petaniGantiSandi(int $id, string $sandi_baru): bool
    {
        $sandi_baru = Hash::make($sandi_baru);
        return Petani::where('id',$id)->update(['kata_sandi' => $sandi_baru]);
    }
    public function kiosResmiCekSandi(int $id, string $sandi_lama): bool
    {
        $kios_resmi = KiosResmi::find($id);
        if(Hash::check($sandi_lama,$kios_resmi->kata_sandi)) return true;
        return false;
    }
    public function kiosResmiGantiSandi(int $id, string $sandi_baru): bool
    {
        $sandi_baru = Hash::make($sandi_baru);
        return KiosResmi::where('id',$id)->update(['kata_sandi' => $sandi_baru]);
    }
    public function pemerintahCekSandi(int $id, string $sandi_lama): bool
    {
        $kios_resmi = Pemerintah::find($id);
        if(Hash::check($sandi_lama,$kios_resmi->kata_sandi)) return true;
        return false;
    }
    public function pemerintahGantiSandi(int $id, string $sandi_baru): bool
    {
        $sandi_baru = Hash::make($sandi_baru);
        return Pemerintah::where('id',$id)->update(['kata_sandi' => $sandi_baru]);
    }
}