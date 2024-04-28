<?php

namespace App\Services;
use App\Models\Petani;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

interface LaporanService
{
    function kiosResmiSetLaporan(int $id_kios_resmi): Collection;
    function kiosResmiSetLaporanByTahun(int $id_kios_resmi, string $tahun, string $musim_tanam): Collection;
    function kiosResmiLaporan($validated): bool;
    function pemerintahSetLaporan(string $tahun, string $musim_tanam): Collection;
    function ajaxGetPetaniFromRiwayat(string $letters): Collection;
    function ajaxGetLaporanFilenames(string $id): string;
}
