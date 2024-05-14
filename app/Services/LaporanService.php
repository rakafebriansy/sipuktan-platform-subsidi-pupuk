<?php

namespace App\Services;
use App\Models\Petani;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

interface LaporanService
{
    function kiosResmiSetLaporan(int $id_kios_resmi): array;
    function kiosResmiSetLaporanByTahun(int $id_kios_resmi, string $tahun, string $musim_tanam): Collection;
    function kiosResmiLaporan($validated): bool;
    function pemerintahSetLaporan(): array;
    function pemerintahSetLaporanByTahun(string $tahun, string $musim_tanam): Collection;
    function pemerintahSetujuiLaporan(int $id): bool;
    function pemerintahTolakLaporan(int $id, string $catatan): bool;
    function pemerintahGetIdKiosResmiByLaporan(int $id_laporan): int;
    function ajaxGetPetaniFromRiwayat(string $letters): Collection;
    function ajaxGetLaporanFilenames(string $id): string;
}
