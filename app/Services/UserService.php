<?php

namespace App\Services;

interface AkunService
{
    function petaniRegister(array $request): void;
    function kiosResmiRegister(array $request): void;
}