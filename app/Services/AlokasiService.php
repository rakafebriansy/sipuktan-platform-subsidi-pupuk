<?php

namespace App\Services;
use App\Http\Requests\PetaniRegisterRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

interface AlokasiService
{
    function petaniSetAlokasi(int $id): Collection;
    function kiosResmiSetAlokasiByTahun(int $id, string $tahun, string $musim_tanam): Collection;
    function kiosResmiSetAlokasi(): Collection;
    function pemerintahSetAlokasi(): array;
    function pemerintahSetAlokasiByTahun(string $tahun, string $musim_tanam): Collection;
    function pemerintahTambahAlokasi(array $alokasi): bool;
    function pemerintahHapusAlokasi(int $id): bool;
    function pemerintahEditAlokasi(array $alokasi): bool;
    function ajaxDetailAlokasiPetani(int $id): string;
}