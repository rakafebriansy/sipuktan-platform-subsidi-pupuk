<?php

namespace App\Services;
use App\Http\Requests\PetaniRegisterRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

interface TransaksiService
{
    function petaniSetTransaksi(int $id_petani): Collection;
    function kiosResmiSetTransaksi(int $id_kios_resmi): Collection;
    function petaniSetCheckoutNonTunai(int $total_harga, string $nama, array $id_alokasis): array;
    function kiosResmiTransaksi(array $id_alokasis): bool;
    function petaniCheckoutNonTunai(array $alokasis): bool;
}