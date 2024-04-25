<?php

namespace App\Services\Impl;

use App\Models\KelompokTani;
use App\Models\KiosResmi;
use App\Models\Pemerintah;
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
    public function petaniLogin(string $nik, string $kata_sandi): object|null
    {
        $petani = Petani::query()->where('nik',$nik)->first();
        if(isset($petani)) {
            if(Hash::check($kata_sandi,$petani->kata_sandi)){
                return $petani;
            }
        }
        return null;
    }
    public function kiosResmiLogin(string $nib, string $kata_sandi): object|null
    {
        $kios_resmi = KiosResmi::query()->where('nib',$nib)->first();
        if(isset($kios_resmi)) {
            if(Hash::check($kata_sandi,$kios_resmi->kata_sandi)){
                return $kios_resmi;
            }
        }
        return null;
    }
    public function pemerintahLogin(string $nama_pengguna, string $kata_sandi): object|null
    {
        $pemerintah = Pemerintah::query()->where('nama_pengguna',$nama_pengguna)->first();
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
    public function petaniGantiSandi(int $id, array $sandi_petani): bool
    {
        $petani = Petani::find($id);
        if(Hash::check($sandi_petani['sandi_lama'],$petani->kata_sandi)) {
            $sandi_baru = Hash::make($sandi_petani['sandi_baru']);
            Petani::query()->where('id',$id)->update(['kata_sandi' => $sandi_baru]);
            return true;
        } else {
            return false;
        }
    }
    public function kiosResmiGantiSandi(int $id, array $sandi_kios): bool
    {
        $kios_resmi = KiosResmi::find($id);
        if(Hash::check($sandi_kios['sandi_lama'],$kios_resmi->kata_sandi)) {
            $sandi_baru = Hash::make($sandi_kios['sandi_baru']);
            KiosResmi::query()->where('id',$id)->update(['kata_sandi' => $sandi_baru]);
            return true;
        } else {
            return false;
        }
    }
    public function pemerintahGantiSandi(int $id, array $sandi_pemerintah): bool
    {
        $pemerintah = Pemerintah::find($id);
        if(Hash::check($sandi_pemerintah['sandi_lama'],$pemerintah->kata_sandi)) {
            $sandi_baru = Hash::make($sandi_pemerintah['sandi_baru']);
            Pemerintah::query()->where('id',$id)->update(['kata_sandi' => $sandi_baru]);
            return true;
        } else {
            return false;
        }
    }
    public function pemerintahSetVerifikasiPengguna(): array
    {
        $petanis = Petani::select('petanis.*','kelompok_tanis.nama as nama_poktan')
        ->join('kelompok_tanis','petanis.id_kelompok_tani','kelompok_tanis.id','kelompok_tanis.id')
        ->where('aktif',false)->get();
        $kios_resmis = KiosResmi::select('kios_resmis.*','pemilik_kios.*','kecamatans.nama as kecamatan')
            ->join('pemilik_kios','kios_resmis.id_pemilik_kios','pemilik_kios.id')
            ->join('kecamatans','kios_resmis.id_kecamatan','kecamatans.id')
            ->where('aktif',false)->get();
        return ['petanis' => $petanis, 'kios_resmis' => $kios_resmis];
    }
    public function pemerintahVerifikasiPetani($ids): bool
    {
        DB::transaction(function() use ($ids) {
            $rows_affected = Petani::whereIn('id',$ids)->update(['aktif' => true]);
            return $rows_affected;
        });
        return false;
    }
    public function pemerintahVerifikasiKiosResmi($ids): bool
    {
        DB::transaction(function() use ($ids) {
            $rows_affected = KiosResmi::whereIn('id',$ids)->update(['aktif' => true]);
            return $rows_affected;
        });
        return false;
    }
}