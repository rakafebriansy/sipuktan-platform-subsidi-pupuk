<?php

namespace App\Services;
use Illuminate\Database\Eloquent\Collection;

interface KeluhanService
{
    function petaniSetKeluhan(int $id_petani): Collection;
    function petaniBuatKeluhan(array $keluhan, int $id_petani): bool;
    function kiosResmiSetKeluhan(int $kios_resmi): Collection;
    function kiosResmiBuatKeluhan(array $keluhan, int $id_kios_resmi): bool;
    function pemerintahSetKeluhan(int $id_pemerintah): Collection;
    function pemerintahBalasKeluhan(array $balasan): bool;
    function getKeluhanDetail(int $id): string;
}

?>