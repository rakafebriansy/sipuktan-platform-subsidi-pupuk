<?php

namespace App\Services;
use App\Http\Requests\PetaniRegisterRequest;
use Illuminate\Http\UploadedFile;

interface DashboardService
{
    function petaniSetSidebar(int $id): array;
    function kiosResmiSetSidebar(int $id): array;
    function pemerintahSetSidebar(int $id): array;
    function setPieChart(): array;
}