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
    function pemerintahGetAlokasiByTahun(string $tahun, string $musim_tanam): Collection;
    function pemerintahTambahAlokasi(array $alokasi): void;
    public function pemerintahHapusAlokasi(int $id): void;
}