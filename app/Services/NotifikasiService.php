<?php

namespace App\Services;
use Illuminate\Database\Eloquent\Collection;

interface NotifikasiService
{
    // function sendNotifikasi(string $notifikasi, string $role, int $id);
    function sendManyNotifikasi(string $notifikasi, string $role, Collection $ids): bool;
}