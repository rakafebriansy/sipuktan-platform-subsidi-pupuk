<?php

namespace App\Services;
use App\Http\Requests\PetaniRegisterRequest;

interface AkunService
{
    function login(string $email, string $password): bool;
    function register(array $request): void;
}