<?php

namespace App\Services;
use App\Models\Petani;
use Illuminate\Database\Eloquent\Collection;

interface LaporanService
{
    function kiosResmiSetLaporan(int $id_kios_resmi): Collection;
    function kiosResmiSetLaporanByTahun(int $id_kios_resmi, int $tahun, string $musim_tanam): Collection;

}
