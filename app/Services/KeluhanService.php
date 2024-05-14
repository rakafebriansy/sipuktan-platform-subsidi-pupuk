<?php

namespace App\Services;
use Illuminate\Database\Eloquent\Collection;

interface KeluhanService
{
    function petaniSetKeluhan(int $id_petani): Collection;
    function petaniBuatKeluhan(array $keluhan, int $id_petani): bool;
    function kiosResmiSetKeluhan(int $kios_resmi): Collection;
    function kiosResmiBuatKeluhan(array $keluhan, int $id_kios_resmi): int|null;
    function pemerintahSetKeluhan(int $id_pemerintah): Collection;
    function pemerintahBalasKeluhan(array $balasan): bool;
    function ajaxGetKeluhanDetail(int $id): string;
    function ajaxGetKeluhanBlade(int $id): string;
}

?>