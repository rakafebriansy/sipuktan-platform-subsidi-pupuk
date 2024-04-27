<?php

namespace App\Services;
use App\Models\Petani;
use Illuminate\Database\Eloquent\Collection;

interface RiwayatTransaksiService
{
    function petaniSetRiwayatTransaksi(int $id_petani): Collection;
    function petaniSetRiwayatTransaksiByTahun(int $id_kios_resmi, string $tahun): Collection;
    function kiosResmiSetRiwayatTransaksi(int $id_kios_resmi): Collection;
    function kiosResmiSetRiwayatTransaksiByTahun(int $id_kios_resmi, string $tahun, string $musim_tanam): Collection;
}
