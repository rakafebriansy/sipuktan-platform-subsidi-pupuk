<?php

namespace App\Services;
use App\Http\Requests\PetaniRegisterRequest;
use Illuminate\Http\UploadedFile;

interface AkunService
{
    function petaniLogin(string $nik, string $kata_sandi): object|null;
    function kiosResmiLogin(string $nib, string $kata_sandi): object|null;
    function pemerintahLogin(string $nama_pengguna, string $kata_sandi): object|null;
    function petaniRegister(array $data_petani, UploadedFile $foto_ktp): void;
    function kiosResmiRegister(array $data_kios, UploadedFile $foto_ktp): void;
    function petaniGantiSandi(int $id, array $sandi_petani): bool;
    function kiosResmiGantiSandi(int $id, array $sandi_kios): bool;
    function pemerintahGantiSandi(int $id, array $sandi_pemerintah): bool;

}