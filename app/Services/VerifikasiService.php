<?php

namespace App\Services;

interface VerifikasiService 
{
    function pemerintahSetVerifikasiPengguna(): array;
    function pemerintahVerifikasiPetani($ids): bool;
    function pemerintahVerifikasiKiosResmi($ids): bool;
}

?>