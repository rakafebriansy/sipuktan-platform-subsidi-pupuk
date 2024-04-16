<?php

namespace App\Services;
use App\Http\Requests\PetaniRegisterRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

interface AlokasiService
{
    function petaniSetAlokasi(int $id): Collection;
    function kiosResmiSetAlokasiByTahun(int $id, string $tahun): Collection;
    function pemerintahSetAlokasiByTahun(string $tahun): array;
    function pemerintahAlokasi(array $alokasi): void;
    public function getAlokasiTahun(): Collection;
}