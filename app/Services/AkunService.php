<?php

namespace App\Services;
use App\Http\Requests\PetaniRegisterRequest;

interface AkunService
{
    function petaniRegister(array $request): void;
    function kiosResmiRegister(array $request): void;
}