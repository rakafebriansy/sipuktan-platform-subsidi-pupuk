<?php

namespace App\Services;
use App\Http\Requests\PetaniRegisterRequest;
use Illuminate\Http\UploadedFile;

interface AkunService
{
    function petaniRegister(array $data_petani, array|UploadedFile $foto_ktp): void;
    function kiosResmiRegister(array $data_kios, array|UploadedFile $foto_ktp): void;
}