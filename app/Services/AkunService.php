<?php

namespace App\Services;
use App\Http\Requests\PetaniRegisterRequest;
use Illuminate\Http\UploadedFile;

interface AkunService
{
    function petaniLogin(string $nik, string $kata_sandi): object|null;
    function petaniCekIngatSaya(string $uuid): bool;
    function kiosResmiLogin(string $nib, string $kata_sandi): object|null;
    function kiosResmiCekIngatSaya(string $uuid): bool;
    function pemerintahLogin(string $nama_pengguna, string $kata_sandi): object|null;
    function petaniRegister(array $data_petani, UploadedFile $foto_ktp): void;
    function kiosResmiRegister(array $data_kios, UploadedFile $foto_ktp): void;
    function petaniCekSandi(int $id, string $sandi_petani): bool;
    function petaniGantiSandi(int $id, string $sandi_petani): bool;
    function petaniGantiNoTelp(int $id, string $no_telp): bool;
    function kiosResmiCekSandi(int $id, string $sandi_kios): bool;
    function kiosResmiGantiSandi(int $id, string $sandi_kios): bool;
    function kiosResmiGantiNoTelp(int $id, string $no_telp): bool;
    function pemerintahCekSandi(int $id, string $sandi_pemerintah): bool;
    function pemerintahGantiSandi(int $id, string $sandi_pemerintah): bool;

}