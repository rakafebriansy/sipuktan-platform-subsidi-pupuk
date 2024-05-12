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
    function petaniSetRiwayatTransaksi(int $id_petani): array;
    function petaniSetRiwayatTransaksiByTahun(int $id_kios_resmi, string $tahun): Collection;
    function kiosResmiSetRiwayatTransaksi(int $id_kios_resmi): array;
    function kiosResmiSetRiwayatTransaksiByTahun(int $id_kios_resmi, string $tahun, string $musim_tanam): Collection;
}