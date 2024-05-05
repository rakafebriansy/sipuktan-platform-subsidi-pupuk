<?php

namespace App\Services;
use App\Http\Requests\PetaniRegisterRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

interface FaqService
{
    function getFaqPetani(): Collection;
    function getFaqKiosResmi(): Collection;
    function pemerintahSetFaq(int $id): Collection;
    function pemerintahBuatFaq(array $validated, int $id): bool;
}