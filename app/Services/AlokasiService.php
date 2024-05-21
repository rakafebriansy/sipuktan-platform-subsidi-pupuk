<?php

namespace App\Services;
use App\Http\Requests\PetaniRegisterRequest;
use App\Models\MusimTanam;
use App\Models\Petani;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

interface AlokasiService
{
    function petaniSetAlokasi(int $id): Collection;
    function kiosResmiSetAlokasiByTahun(int $id, string $tahun, string $musim_tanam): Collection;
    function kiosResmiSetAlokasi(int $id): array;
    function kiosResmiAlokasi(array $id_alokasis): bool;
    function kiosResmiGetDistinctIdPetaniByTahunMusimTanam(string $tahun, string $musim_tanam): array;
    function pemerintahSetAlokasi(): array;
    function pemerintahSetAlokasiByTahun(string $tahun, string $musim_tanam): Collection;
    function pemerintahCekPetani(string $nik): Petani|null;
    function pemerintahBuatAlokasi(array $alokasi,Petani $petani): bool;
    function pemerintahHapusAlokasi(int $id): bool;
    function pemerintahEditAlokasi(array $alokasi): bool;
    function ajaxDetailAlokasiPetani(int $id): string;
    function ajaxDetailAlokasiPetaniByPemerintah(int $id): string;
}