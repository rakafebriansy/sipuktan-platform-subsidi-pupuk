<?php

namespace App\Services;
use App\Http\Requests\PetaniRegisterRequest;
use App\Models\KiosResmi;
use App\Models\PemilikKios;
use App\Models\Petani;
use Illuminate\Http\UploadedFile;

interface AkunService
{
    function petaniLogin(string $nik, string $kata_sandi): object|null;
    function petaniCekIngatSaya(string $uuid): bool;
    function kiosResmiLogin(string $nib, string $kata_sandi): object|null;
    function kiosResmiCekIngatSaya(string $uuid): bool;
    function pemerintahLogin(string $nama_pengguna, string $kata_sandi): object|null;
    function petaniRegister(array $data_petani, UploadedFile $foto_ktp): void;
    function petaniLupaSandi(string $nomor_telepon): Petani;
    function petaniLupaUbahSandi(int $id, string $sandi_baru): bool;
    function kiosResmiRegister(array $data_kios, UploadedFile $foto_ktp): void;
    function petaniCekSandi(int $id, string $sandi_petani): bool;
    function petaniUbahSandi(int $id, string $sandi_petani): bool;
    function petaniUbahNoTelp(int $id, string $no_telp): bool;
    function kiosResmiCekSandi(int $id, string $sandi_kios): bool;
    function kiosResmiUbahSandi(int $id, string $sandi_kios): bool;
    function kiosResmiUbahNoTelp(int $id, string $no_telp): bool;
    function pemerintahCekSandi(int $id, string $sandi_pemerintah): bool;
    function pemerintahUbahSandi(int $id, string $sandi_pemerintah): bool;
    function kiosResmiLupaSandi(string $nomor_telepon): KiosResmi;
    function kiosResmiLupaUbahSandi(int $id, string $sandi_baru): bool;

}