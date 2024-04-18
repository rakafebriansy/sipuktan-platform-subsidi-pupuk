<?php

namespace App\Services;
use App\Http\Requests\PetaniRegisterRequest;
use Illuminate\Http\UploadedFile;

interface AkunService
{
    function petaniRegister(array $data_petani, array|UploadedFile $foto_ktp): void;
    function kiosResmiRegister(array $data_kios, array|UploadedFile $foto_ktp): void;
    function petaniGantiSandi(int $id, array $sandi_petani): bool;
    function kiosResmiGantiSandi(int $id, array $sandi_kios): bool;
    function pemerintahGantiSandi(int $id, array $sandi_pemerintah): bool;
    function pemerintahSetVerifikasiPengguna(): array;
    function pemerintahVerifikasiPetani($ids): bool;
    function pemerintahVerifikasiKiosResmi($ids): bool;
}