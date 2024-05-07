<?php

namespace App\Services;
use Illuminate\Database\Eloquent\Collection;

interface KeluhanService
{
    function petaniSetKeluhan(int $id_petani): Collection;
    function petaniKeluhan(array $keluhan, int $id_petani): bool;
    function kiosResmiSetKeluhan(int $kios_resmi): Collection;
    function kiosResmiKeluhan(array $keluhan, int $id_kios_resmi): bool;
    function pemerintahSetKeluhan(int $id_pemerintah): Collection;
    function pemerintahBalasKeluhan(string $balasan, int $id_keluhan): bool;
}

?>