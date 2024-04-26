<?php

namespace App\Services;
use App\Models\Petani;
use Illuminate\Database\Eloquent\Collection;

interface RiwayatTransaksiService
{
    function petaniSetRiwayatTransaksi(int $id_petani): Collection;
    function petaniSetRiwayatTransaksiByTahun(int $id, int $tahun): Collection;
    function kiosResmiSetRiwayatTransaksi(int $id_kios_resmi): Collection;
    function kiosResmiSetRiwayatTransaksiByTahun(int $id, int $tahun): Collection;
}
