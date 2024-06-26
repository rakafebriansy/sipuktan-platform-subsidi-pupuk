<?php

namespace App\Services\Impl;

use App\Models\KiosResmi;
use App\Models\Pemerintah;
use App\Models\PemilikKios;
use App\Models\Petani;
use App\Services\AkunService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AkunServiceImpl implements AkunService
{    
    public function petaniLogin(string $nik, string $kata_sandi): object|null
    {
        $kredensial = [
            'nik' => $nik,
            'password' => $kata_sandi
        ];
        if(Auth::guard('petani')->attempt($kredensial)) {
            $petani = Petani::where('nik',$nik)->first();
            Auth::guard('petani')->login($petani);
            return $petani;
        }
        return null;
    }
    public function petaniCekIngatSaya(string $uuid): bool
    {
        return Petani::where('uuid',$uuid)->exists();
    }
    public function kiosResmiCekIngatSaya(string $uuid): bool
    {
        return KiosResmi::where('uuid',$uuid)->exists();
    }
    public function kiosResmiLogin(string $nib, string $kata_sandi): object|null
    {
        $kredensial = [
            'nib' => $nib,
            'password' => $kata_sandi
        ];
        if(Auth::guard('kiosResmi')->attempt($kredensial)) {
            $kios_resmi = KiosResmi::where('nib',$nib)->first();
            Auth::guard('kiosResmi')->login($kios_resmi);
            return $kios_resmi;
        }
        return null;
    }
    public function pemerintahLogin(string $nama_pengguna, string $kata_sandi): object|null
    {
        $kredensial = [
            'nama_pengguna' => $nama_pengguna,
            'password' => $kata_sandi
        ];
        if(Auth::guard('pemerintah')->attempt($kredensial)) {
            $pemerintah = Pemerintah::where('nama_pengguna',$nama_pengguna)->first();
            Auth::guard('pemerintah')->login($pemerintah);
            return $pemerintah;
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
    public function petaniUbahSandi(int $id, string $sandi_baru): bool
    {
        $sandi_baru = Hash::make($sandi_baru);
        return DB::transaction(function() use($id, $sandi_baru) {
            return Petani::where('id',$id)->update(['kata_sandi' => $sandi_baru]);
        });
    }
    public function petaniUbahNoTelp(int $id, string $no_telp): bool
    {
        return DB::transaction(function() use($id, $no_telp){
            return Petani::where('id',$id)->update(['nomor_telepon' => $no_telp]);
        });
    }
    public function kiosResmiCekSandi(int $id, string $sandi_lama): bool
    {
        $kios_resmi = KiosResmi::find($id);
        if(Hash::check($sandi_lama,$kios_resmi->kata_sandi)) return true;
        return false;
    }
    public function kiosResmiUbahSandi(int $id, string $sandi_baru): bool
    {
        $sandi_baru = Hash::make($sandi_baru);
        return DB::transaction(function() use($id, $sandi_baru) {
            return KiosResmi::where('id',$id)->update(['kata_sandi' => $sandi_baru]);
        });
    }
    public function kiosResmiUbahNoTelp(int $id, string $no_telp): bool
    {
        return DB::transaction(function() use($id, $no_telp){
            $pemilik_kios = KiosResmi::find($id)->pemilik_kios();
            return $pemilik_kios->update(['nomor_telepon' => $no_telp]);
        });
    }
    public function pemerintahCekSandi(int $id, string $sandi_lama): bool
    {
        $kios_resmi = Pemerintah::find($id);
        if(Hash::check($sandi_lama,$kios_resmi->kata_sandi)) return true;
        return false;
    }
    public function pemerintahUbahSandi(int $id, string $sandi_baru): bool
    {
        $sandi_baru = Hash::make($sandi_baru);
        return DB::transaction(function() use($id, $sandi_baru) {
            return Pemerintah::where('id',$id)->update(['kata_sandi' => $sandi_baru]);
        });
    }
    public function petaniLupaSandi(string $nomor_telepon): Petani
    {
        return Petani::where('nomor_telepon',$nomor_telepon)->first();
    }
    public function kiosResmiLupaSandi(string $nomor_telepon): KiosResmi
    {
        $pemilik_kios = PemilikKios::where('nomor_telepon',$nomor_telepon)->first();
        return $pemilik_kios->kios_resmi;
    }
    public function petaniLupaUbahSandi(int $id, string $sandi_baru): bool
    {
        $sandi_baru = Hash::make($sandi_baru);
        return DB::transaction(function() use($id, $sandi_baru) {
            $petani = Petani::find($id);
            return $petani->update([
                'kata_sandi' => $sandi_baru,
                'token' => null
            ]);
        });
    }
    public function kiosResmiLupaUbahSandi(int $id, string $sandi_baru): bool
    {
        $sandi_baru = Hash::make($sandi_baru);
        return DB::transaction(function() use($id, $sandi_baru) {
            $kios_resmi = KiosResmi::find($id);
            return $kios_resmi->update([
                'kata_sandi' => $sandi_baru,
                'token' => null
            ]);
        });
    }

}