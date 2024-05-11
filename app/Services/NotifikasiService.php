<?php

namespace App\Services;

interface NotifikasiService
{
    function sendNotifikasi(string $notifikasi, string $role, int $id): int;
    function sendManyNotifikasi(string $notifikasi, string $role, array $ids): array;
    function ajaxDeleteNotifikasi(int $id): bool;
}