<?php

namespace App\Services;
use Illuminate\Database\Eloquent\Collection;

interface CrudService
{
    function pemerintahSetKelompokTani(): Collection;
    function pemerintahBuatKelompokTani(array $data): bool;
    function pemerintahEditKelompokTani(array $data): bool;
    function pemerintahHapusKelompokTani(int $id): bool;
}