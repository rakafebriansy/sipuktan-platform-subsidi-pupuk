<?php

namespace App\Services;
use App\Http\Requests\PetaniRegisterRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

interface TransaksiService
{
    function petaniSetTransaksi(int $id): Collection;
    function petaniSetCheckout(int $total_harga, string $nama, array $id_alokasis): array;
    function petaniCheckout(array $alokasis): bool;
}