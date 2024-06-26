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
    function pemerintahBuatFaq(array $data, int $id): bool;
    function pemerintahEditFaq(array $data): bool;
    function pemerintahHapusFaq(int $id): bool;
    function ajaxGetFaqDetail(int $id): string;
}